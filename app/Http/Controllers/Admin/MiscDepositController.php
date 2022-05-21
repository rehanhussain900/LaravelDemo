<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MiscDepositDataTable;
use App\Helpers\PestPac;
use App\Helpers\Theme;
use App\Http\Controllers\Controller;
use App\Http\Requests\MiscDepositCreateRequest;
use App\Models\GlAccountNumber;
use App\Models\MiscDeposit;
use App\Models\PestPacBranch;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;

/**
 *
 */
class MiscDepositController extends Controller
{

    /**
     * @param MiscDepositDataTable $dataTable
     *
     * @return mixed
     */
    public function index( MiscDepositDataTable $dataTable )
    {
        $data = [
            'branches'    => PestPac::branches(),
            'gl_accounts' => GlAccountNumber::orderBy( 'label' )->get()
        ];
        return $dataTable->render( 'admin.misc-deposits.index', $data );
    }// index

    /**
     * @param MiscDepositCreateRequest $request
     *
     * @return JsonResponse
     */
    public function store( MiscDepositCreateRequest $request ) : JsonResponse
    {
        if( empty( $request->confirmed ) ) {
            $data = $request->all();
            $data[ 'branch' ] = PestPacBranch::whereBranchId( $data[ 'branch_id' ] )->first();
            $data[ 'gl_account' ] = GlAccountNumber::whereNumber( $data[ 'gl_account_number' ] )->first();
            $view = Theme::view( 'misc-deposits.confirm', [ 'data' => $data ] )->render();
            return new JsonResponse( [ 'view' => $view, 'status' => 'not confirmed' ] );
        }

        MiscDeposit::create( $request->all() );

        return new JsonResponse( [ 'status' => 'ok', 'message' => 'Misc Deposit record added' ] );
    }// store

    /**
     * @param MiscDeposit $deposit
     *
     * @return JsonResponse
     */
    public function edit( MiscDeposit $deposit ) : JsonResponse
    {
        return new JsonResponse( $deposit );
    }// edit

    /**
     * @param MiscDepositCreateRequest $request
     * @param MiscDeposit $deposit
     *
     * @return JsonResponse
     */
    public function update( MiscDepositCreateRequest $request, MiscDeposit $deposit ) : JsonResponse
    {
        if( empty( $request->confirmed ) ) {
            $data = $request->all();
            $data[ 'branch' ] = PestPacBranch::whereBranchId( $data[ 'branch_id' ] )->first();
            $data[ 'gl_account' ] = GlAccountNumber::whereNumber( $data[ 'gl_account_number' ] )->first();
            $view = Theme::view( 'misc-deposits.confirm', [ 'data' => $data ] )->render();
            return new JsonResponse( [ 'view' => $view, 'status' => 'not confirmed' ] );
        }

        $deposit->fill( $request->all() )->save();

        return new JsonResponse( [ 'status' => 'ok', 'message' => 'Misc Deposit record Updated' ] );
    }// update

    /**
     * @param MiscDeposit $deposit
     *
     * @return JsonResponse
     */
    public function destroy( MiscDeposit $deposit ) : JsonResponse
    {
        $deposit->delete();
        return new JsonResponse( [ 'message' => 'Misc Deposit Deleted' ] );
    }// destroy

}// MiscDepositController
