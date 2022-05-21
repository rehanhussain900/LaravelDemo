<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\QualityAssuranceSurveyCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Services\QualityAssuranceSurveyService;
use App\Jobs\SendSurveyDocument;
use App\Services\DocuSignService;
use App\Enums\SurveyDocuSignStatus;

class QualityAssuranceSurveyAPIController extends Controller
{
    
    /**
     * @var QualityAssuranceSurveyService
     */
    private $surveyService;

    /**
     * @var DocuSignService
     */
    private $docuSignService;

    /**
     * @param QualityAssuranceSurveyService $surveyService
     */
    public function __construct(
        QualityAssuranceSurveyService $surveyService,
        DocuSignService $service
    ) {
        $this->surveyService = $surveyService;
        $this->docuSignService = $service;
    }// __construct

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\QualityAssuranceSurveyCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualityAssuranceSurveyCreateRequest $request)
    {
        try{
            $data = $request->all();
            $survey = $this->surveyService->saveSurvey($data);
            if($survey){
                $survey = $this->sendDocs($survey);
                return new JsonResponse( [ 'message' => 'Survey Added', 'status' => 1, 'data' => $survey  ], 200 );
            }
            return new JsonResponse( [ 'message' => 'Something went wrong' , 'status' => 0, 'data' => '' ], 200 );
        }
        catch(\Exception $e){
            return new JsonResponse( [ 'message' => $e->getMessage() , 'status' => 0, 'data' => '' ], 200 );
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try{
            $survey = $this->surveyService->getSurvey($id);
            if($survey){
                return new JsonResponse( [ 'message' => '', 'status' => 1, 'data' => $survey  ], 200 );
            }
            return new JsonResponse( [ 'message' => 'No Data Found' , 'status' => 0, 'data' => '' ], 200 );
        }
        catch(\Exception $e){
            return new JsonResponse( [ 'message' => $e->getMessage() , 'status' => 0, 'data' => '' ], 200 );
        }
    }

     /**
     * Send Documents for sign
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendDocs($survey)
    {
        $this->docuSignService->authenticate();
        $this->docuSignService->setContractId( $survey->id );
        $this->docuSignService->setDocType( 'survey' );
        $signer = array(        
            array(
                'signer_name'   => 'Babar F',
                'signer_email'  => 'babarf.allshore@gmail.com',
                        'sign'  =>  [
                                'anchor_string'   => 'Auditor Signature', 'anchor_units' => 'pixels',
                                'anchor_y_offset' => '-25', 'anchor_x_offset' => '5'
                            ]
                ),
            array(
                'signer_name'   => 'Babar Malik',
                'signer_email'  => 'babarmalik6444@gmail.com',
                        'sign'  =>  [
                                'anchor_string'   => 'Technician Signature', 'anchor_units' => 'pixels',
                                'anchor_y_offset' => '-25', 'anchor_x_offset' => '5'
                            ]
                ),

        );
        $this->docuSignService->pushSigner( $signer );
        $this->docuSignService->setSubject( 'Please Sign this Document' );
        $this->docuSignService->setReturnUrl( route( 'admin.qas.signed', $survey->id)  );
        $file = QualityAssuranceSurveyService::preparePDF($survey);
        $this->docuSignService->setDocument( $file );
        $res = $this->docuSignService->createEnvelope();
        $envelope_id = $this->docuSignService->getEnvelopeResponse()->getEnvelopeId();
        $survey->envelope_id = $envelope_id;
        $survey->auditor_signature_status = SurveyDocuSignStatus::SENT;
        $survey->save();
        return $survey->refresh();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSurveyQuestions($type)
    {
        try{
            $type = str_replace('-', ' ', $type);
            $data = $this->surveyService->getSurveyQuestion($type);
            return new JsonResponse( [ 'message' => '', 'status' => 1, 'data' => $data  ], 200 );
        }
        catch(\Excepttion $e){
            return new JsonResponse( [ 'message' => 'Something went wrong' , 'status' => 0, 'data' => '' ], 200 );
        }
        
    }
}
