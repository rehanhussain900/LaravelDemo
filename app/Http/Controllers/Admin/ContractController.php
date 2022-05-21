<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContractsDataTable;
use App\Enums\ContractStatus;
use App\Helpers\Theme;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContractCustomerInfoRequest;
use App\Http\Requests\ContractServicesRequest;
use App\Http\Requests\AssignContractRequest;
use App\Models\Contract;
use App\Models\Service;
use App\Models\Specie;
use App\Services\ContractService;
use App\Services\DocuSignService;
use App\Services\UserService;
use DocuSign\eSign\Client\ApiException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Mail\SendContractEmail;

/**
 *
 */
class ContractController extends Controller
{
    private $docuSignService;

    /**
     * @var ContractService
     */
    private $contractService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @param DocuSignService $service
     * @param ContractService $contractService
     */
    public function __construct(
        DocuSignService $service,
        ContractService $contractService,
        UserService $userService 
    ) {
        $this->docuSignService = $service;
        $this->contractService = $contractService;
        $this->userService = $userService;
    }// __construct

    /**
     * @return Application|Factory|View
     */
    public function index( ContractsDataTable $dataTable )
    {
        return $dataTable->render( 'admin.contracts.index' );
    }// index

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'selected' => $this->contractService->getSessionData(),
            'species'  => Specie::orderBy( 'sort_order' )->get(),
            'services' => Service::orderBy( 'sort_order' )->with( 'children' )->whereParentId( 0 )->get(),
        ];
        return Theme::view( 'contracts.create', $data );
    }// create

    /**
     * @param ContractCustomerInfoRequest $request
     *
     * @return JsonResponse
     */
    public function storeCustomerInfo( ContractCustomerInfoRequest $request ) : JsonResponse
    {
        $this->contractService->setCustomerInfo( $request->all() );
        return new JsonResponse( [ 'message' => 'Customer Info Saved' ] );
    }// storeCustomerInfo

    /**
     * @param ContractServicesRequest $request
     *
     * @return JsonResponse
     */
    public function storeServices( ContractServicesRequest $request ) : JsonResponse
    {
        $data = $request->all();
        //dd( $request->only( $data[ 'species' ] ) );
        $this->contractService->setSpecies( $data[ 'species' ] );
        $this->contractService->setServices( $request->only( $data[ 'species' ] ) );
        return new JsonResponse( [ 'message' => 'Services Saved', 'update' => $this->contractService->getSessionData() ] );
    }// storeServices

    /**
     * @param Contract $contract
     *
     * @return JsonResponse
     */
    public function edit( Contract $contract ) 
    {
        //dd($contract->load(['services' , 'species' , 'serviceState' , 'billingState']));
        
        $contract = $contract->load(['services' , 'species' , 'serviceState' , 'billingState']);
        $species  = Specie::orderBy( 'sort_order' )->get();
        $services = Service::orderBy( 'sort_order' )->with( 'children' )->whereParentId( 0 )->get();
       
        //dd($contract);
        return Theme::view( 'contracts.edit', compact('contract', 'species', 'services') );
    }// edit

    /**
     * @param Request $request
     * @param Contract $contract
     *
     * @return JsonResponse
     */
    public function update( Request $request, Contract $contract ) : JsonResponse
    {

        return new JsonResponse( [] );
    }// update

    /**
     *
     */
    public function confirm() : JsonResponse
    {
        //$contract = $this->contractService->getDecoratedSessionData();
        $pdf_id = 'tmp-' . Auth::id();
        $this->contractService->preparePdf( $pdf_id );
        $view = Theme::view( 'contracts.create-parts.confirm', [ 'pdf_id' => $pdf_id ] )
                     ->render();
        return new JsonResponse( [ 'view' => $view, 'url' => asset( 'contracts/contract-' . $pdf_id . '.pdf?v=' . time() ) ] );
    }

    /**
     * @return Application|Factory|View
     */
    public function preview()
    {
        $session = $this->contractService->getDecoratedSessionData();
        return view( 'admin.templates.contracts.default', $session );
    }// preview

    /**
     * @return JsonResponse
     * @throws ApiException
     * @throws FileNotFoundException
     */
    public function sign() : JsonResponse
    {
        $contract = $this->contractService->make(); 
        $this->docuSignService->authenticate();
        $this->docuSignService->setContractId( $contract->id );
        $this->docuSignService->setSigner( 'Fayaz K', 'fayazk6611@gmail.com' );
        $this->docuSignService->setSignerCC( 'Babar F', 'babarf.allshore@gmail.com' );
        $this->docuSignService->setSubject( 'Please Sign this Document' );
        $file = public_path( 'contracts/contract-' . $contract->id . '.pdf' );
        $this->docuSignService->setDocument( $file );
        $res = $this->docuSignService->createEnvelope()->generateEmbeddedSignature();
        $contract->envelope_id = $this->docuSignService->getEnvelopeResponse()->getEnvelopeId();
        $contract->status = ContractStatus::SENT;
        $contract->save();
        $contract->refresh();

        return new JsonResponse( [ 'url' => $res->getUrl() ] );
    }// sign

    /**
     *
     */
    public function signed( Request $request, Contract $contract )
    {
        $event = $request->input( 'event' );
        if( $event === 'signing_complete' ) {
            $contract->status = ContractStatus::SIGNED;
        } elseif( $event === 'decline' ) {
            $contract->status = ContractStatus::DECLINED;
        }
        $contract->save();

        return Theme::view( 'contracts.signed', compact( 'event' ) );
    }// signed

    /**
     *
     */
    public function send(Contract $contract )
    {
    	Mail::to($contract->email)->send(new SendContractEmail($contract));
        return new JsonResponse( [ 'message' => 'Invoice Sent.' ] );
    }// signed

    /**
     *
     */
    public function assign(Contract $contract )
    {
        $technicians = $this->userService->getUserByRole('Technician');
    	return Theme::view( 'contracts.assign', compact( 'contract' , 'technicians' ) );
    }// signed

    /**
     *
     */
    public function assignContarct(Contract $contract , AssignContractRequest $request )
    {
        try{
            if($contract){
                $data = $request->validated();
                $check = $this->contractService->updateContract($contract->id , $data);
                if($check){
                    return new JsonResponse( [ 'message' => 'Assigned Successfully.' ] );
                }
                return new JsonResponse( [ 'message' => 'Opps! Contract Not Assigned. Try again please' ] );
            }
            return new JsonResponse( [ 'message' => 'Opps! No Contract Found.' ] );
        }
        catch(\Exception $e){
            return new JsonResponse( [ 'message' => $e->getMessage() ] );
        }
        
    }// signed

    /**
     * @param Contract $contract
     *
     * @return JsonResponse
     */
    public function destroy( Contract $contract ) : JsonResponse
    {
        //$contract->delete();
        try{
            if($contract){
                if($this->contractService->deleteContractForUser($contract->id)){
                    return new JsonResponse( [ 'message' => 'Contract Deleted' ] );
                }
                return new JsonResponse( [ 'message' => 'Opps! Contract Not Deleted' ] ); 
            }
            return new JsonResponse( [ 'message' => 'Opps! Contract Not Found.' ] );
        }
        catch(\Exception $e){
            return new JsonResponse( [ 'message' => 'Opps! Something Went Wrong.' ] );
        }
    }// destroy

}// ContractController
