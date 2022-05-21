<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SurveyDocuSignStatus;
use App\DataTables\FieldAuditSurveyDataTable;
use App\DataTables\SentriconAuditSurveyDataTable;
use App\Models\QualityAssuranceSurvey;
use App\Models\User;

use App\Helpers\Theme;

use App\Services\QualityAssuranceSurveyService;
use App\Services\DocuSignService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QualityAssuranceSurveyController extends Controller
{
    private $docuSignService;
    /**
     * @var QualityAssuranceSurveyService
     */
    private $surveyService;

    /**
     * @param DocuSignService $service
     * @param QualityAssuranceSurveyService $service
     */
    public function __construct(
        QualityAssuranceSurveyService $service,
        DocuSignService $docuSignService
    ) {
        $this->surveyService    = $service;
        $this->docuSignService  = $docuSignService;
    }// __construct

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FieldAuditSurveyDataTable $dataTable)
    {
        return $dataTable->render( 'admin.quality-assurance-surveys.field-audit.index' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sentricon(SentriconAuditSurveyDataTable $dataTable)
    {
        return $dataTable->render( 'admin.quality-assurance-surveys.sentricon-audit.index' );
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QualityAssuranceSurvey  $qualityAssuranceSurvey
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey = $this->surveyService->getSurvey($id);
        //dd($survey->questionTitle[0]->questions[0]->answer);
        if($survey){
            if($survey->type=='Sentricon Audit'){
                return Theme::view( 'quality-assurance-surveys.sentricon-audit.preview', compact('survey'));
            }
            return Theme::view( 'quality-assurance-surveys.field-audit.preview', compact('survey'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QualityAssuranceSurvey  $qualityAssuranceSurvey
     * @return \Illuminate\Http\Response
     */
    public function edit(QualityAssuranceSurvey $qualityAssuranceSurvey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QualityAssuranceSurvey  $qualityAssuranceSurvey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QualityAssuranceSurvey $qualityAssuranceSurvey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QualityAssuranceSurvey  $qualityAssuranceSurvey
     * @return \Illuminate\Http\Response
     */
    public function destroy(QualityAssuranceSurvey $qualityAssuranceSurvey)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFieldAuditSurveyList()
    {
        $technicians = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Technician');
            }
        )->get();
        return Theme::view( 'quality-assurance-surveys.index', compact('technicians'));
    }

    /**
     * Export Survey by ID 
     *
     * @return \Illuminate\Http\Response
     */
    public function exportSurvey($id)
    {
        $survey = $this->surveyService->getSurvey($id);
        if(empty($survey)){ abort(404); }
        $path = public_path('surveys');
        $filename ='survey_'.$id.'.pdf';
        if (file_exists( $path . '/' . $filename)) {
             return redirect(URL('surveys/'). '/' . $filename);
        }   
        $pdf = $survey->type=='Sentricon Audit' ? \PDF::loadView( 'admin.quality-assurance-surveys.sentricon-audit.pdf_preview', compact( 'survey' ) ) : \PDF::loadView( 'admin.quality-assurance-surveys.field-audit.pdf_preview', compact( 'survey' ) );
        
        $pdf->save( $path . '/' . $filename);
        return $pdf->stream( 'survey.pdf' );
    }

     /**
     * Export Survey by ID 
     *
     * @return \Illuminate\Http\Response
     */
    // public function sign ($id, $signer)
    // {
    //     $survey = $this->surveyService->getSurvey($id);
    //     if(empty($survey)){ abort(404); }

    //     dd($survey);

    //     $this->docuSignService->authenticate();
    //     $this->docuSignService->setContractId( $survey->id );
    //     $this->docuSignService->setSigner( 'Babar F', 'babarf.allshore@gmail.com' );
    //     $this->docuSignService->setSubject( 'Please Sign this Document' );
    //     $sign  = [
    //         'anchor_string'   => $signer.' Signature', 'anchor_units' => 'pixels',
    //         'anchor_y_offset' => '-25', 'anchor_x_offset' => '5'
    //     ];
    //     $this->docuSignService->setSign( $sign  );
    //     $this->docuSignService->setReturnUrl( route( 'admin.qas.signed', [ 'id' => $survey->id, 'signer' => $signer ])  );

    //     $file = $this->surveyService->preparePDF($survey);
    //     $this->docuSignService->setDocument( $file );

        
    //     $res = $this->docuSignService->createEnvelope()->generateEmbeddedSignature();
    //     $envelope_id = $this->docuSignService->getEnvelopeResponse()->getEnvelopeId();
    //     if($signer == 'Auditor'){
    //         $survey->envelope_id = $envelope_id;
    //         $survey->auditor_signature_status = SurveyDocuSignStatus::SENT;
    //     }
    //     else{
    //         $survey->auditor_envelope_id = $envelope_id;
    //         $survey->auditor_signature_status = SurveyDocuSignStatus::SENT;
    //     }
        
    //     $survey->save();
    //     $survey->refresh();

    //     //return redirect($res->getUrl());
    // }

    /**
     *
     */
    // public function signed( Request $request, $id , $signer )
    // {
    //     $event = $request->input( 'event' );
    //     if( $event === 'signing_complete' ) {
    //         if($signer == 'Auditor')
    //             $this->surveyService->updateSurvey(array('auditor_signature_status' => SurveyDocuSignStatus::SIGNED) , $id);
    //         else
    //             $this->surveyService->updateSurvey(array('technician_signature_status' => SurveyDocuSignStatus::SIGNED) , $id);
    //     } elseif( $event === 'decline' ) {
    //         if($signer == 'Auditor')
    //             $this->surveyService->updateSurvey(array('auditor_signature_status' => SurveyDocuSignStatus::DECLINED) , $id);
    //         else
    //             $this->surveyService->updateSurvey(array('technician_signature_status' => SurveyDocuSignStatus::DECLINED) , $id);
    //     }

    //     return Theme::view( 'quality-assurance-surveys.signed', compact( 'event' ) );
    // }// signed
}
