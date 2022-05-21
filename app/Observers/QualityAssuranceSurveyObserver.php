<?php

namespace App\Observers;

use App\Models\QualityAssuranceSurvey;
use App\Enums\SurveyDocuSignStatus;

use App\Services\QualityAssuranceSurveyService;
use App\Services\DocuSignService;

class QualityAssuranceSurveyObserver
{
    private $docuSignService;
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */

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
    }
    public function created(QualityAssuranceSurvey $survey)
    {
        return true;
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
        $file = $this->surveyService->preparePDF($survey);
        $this->docuSignService->setDocument( $file );
        $res = $this->docuSignService->createEnvelope();
        $envelope_id = $this->docuSignService->getEnvelopeResponse()->getEnvelopeId();
        $survey->envelope_id = $envelope_id;
        $survey->auditor_signature_status = SurveyDocuSignStatus::SENT;
        $survey->save();
        $survey->refresh();
    }
}
