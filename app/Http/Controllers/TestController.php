<?php

namespace App\Http\Controllers;

use App\Helpers\Theme;
use App\Models\State;
use App\Services\MicrosoftGraphService;
use App\Services\PestPac\Document;
use App\Services\PestPacService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JsonException;
use Microsoft\Graph\Exception\GraphException;
use MongoDB\Driver\Session;

/**
 * Test controller for testing functionality
 */
class TestController extends Controller
{
    /**
     * @var PestPacService
     */
    private $pestPacApi;

    /**
     * @param PestPacService $pestPacService
     */
    public function __construct( PestPacService $pestPacService )
    {
        $this->pestPacApi = $pestPacService;
    }// __construct

    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws GraphException
     */
    public function index()
    {
        $api = new MicrosoftGraphService();
        $api->authenticate();
        dd( $api->getUser() );
        /*$guzzle = new \GuzzleHttp\Client();
        $url = 'https://login.microsoftonline.com/' . config( 'services.azure.tenant' ) . '/oauth2/token?api-version=1.0';
        $token = json_decode( $guzzle->post( $url, [
            'form_params' => [
                'client_id'     => config( 'services.azure.client_id' ),
                'client_secret' => config( 'services.azure.client_secret' ),
                'resource'      => 'https://graph.microsoft.com/',
                'grant_type'    => 'client_credentials',
            ],
        ] )->getBody()->getContents() );
        dd($token);
        $accessToken = $token->access_token;*/
    }// index

    /**
     * @return string
     * @throws GuzzleException
     * @throws JsonException
     */
    public function pestUpload()
    {
        $this->pestPacApi->authenticate();
        $document = new Document( $this->pestPacApi );
        return $document->getByID( 12050728, Document::DOCUMENT_TYPE_LOCATION_DOCUMENT );
        /*$file = Storage::disk( 'global' )->path( 'contracts/sample.pdf' );
        $output = $document->upload( 12050728, Document::DOCUMENT_TYPE_LOCATION_DOCUMENT, $file );
        return $output->getBody()->getContents();*/
    }// index

    public function map()
    {
        return Theme::view( 'daily-production-reports.map' );
    }

    /**
     *
     */
    public function pdf( Request $request )
    {
        $data = [
            'customer_info' => [
                'name'             => '',
                'business_name'    => '',
                'business_address' => '',
                'business_city'    => '',
                'business_state'   => State::find( 1 ),
                'business_zip'     => '',
                'phone_2'       => '',
                'email'            => '',
                'service_address'  => '',
                'service_city'     => '',
                'service_state'    => State::find( 2 ),
                'service_zip'      => '',
                'phone_1'       => '',
                'attention_line'   => '',
                'account_number'   => '',
                'contract_date'    => '2021-01-01',
                'proposed_by'      => '',
                'billing_zip'      => '',
                'billing_address'      => '',
                'billing_city'      => '',
                'billing_state_id'      => State::find(1),
                'service_state_id'      => State::find(1),
            ]
        ];
        if( $request->has( 'debug' ) ) {
            return view( 'admin.templates.contracts.default', $data );
        }

        $pdf = \PDF::loadView( 'admin.templates.contracts.default', $data );
        $pdf->save( 'contracts/invoice.pdf' );
        return $pdf->stream( 'invoice.pdf' );
        /*$html = $html->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML( $html );
        return $mpdf->Output();*/
    }// pdf

    public function getServiceOrders()
    {
        $this->pestPacApi->authenticate();
    }

}// TestController
// 12050728, 12050727, 1205076
