<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\QualityAssuranceSurvey;
use App\Services\DocuSignService;
use DocuSign\eSign\Client\ApiException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 *
 */
class DocuSignController extends Controller
{

    /**
     * @var DocuSignService
     */
    private $docuSignService;

    /**
     * @param DocuSignService $docuSignService
     */
    public function __construct( DocuSignService $docuSignService )
    {
        $this->docuSignService = $docuSignService;
    }// __construct

    /**
     * @param Contract $contract
     *
     * @return BinaryFileResponse
     * @throws ApiException
     * @throws FileNotFoundException
     */
    public function download( Contract $contract ) : BinaryFileResponse
    {
        $envelope_id = $contract->envelope_id;
        $this->docuSignService->authenticate();
        $doc = $this->docuSignService->getFirstDocument( $envelope_id );

        $doc_id = $doc->getDocumentId();

        $document = $this->docuSignService->getDocument( $doc_id, $envelope_id );
        return Response::download( $document, $doc->getName() );
    }// download

        /**
     * @param QualityAssuranceSurvey $contract
     *
     * @return BinaryFileResponse
     * @throws ApiException
     * @throws FileNotFoundException
     */
    public function surveyDownload( $id ) : BinaryFileResponse
    {
        $survey = QualityAssuranceSurvey::find($id);
        $envelope_id = $survey->envelope_id;
        //dd($survey);
        $this->docuSignService->authenticate();
        $doc = $this->docuSignService->getFirstDocument( $envelope_id );

        $doc_id = $doc->getDocumentId();

        $document = $this->docuSignService->getDocument( $doc_id, $envelope_id );
        return Response::download( $document, $doc->getName() );
    }// download

}// DocuSignController
