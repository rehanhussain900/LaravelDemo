<?php

namespace App\Traits;

use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Model\CarbonCopy;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\Envelope;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\EnvelopeDocument;
use DocuSign\eSign\Model\EnvelopeDocumentsResult;
use DocuSign\eSign\Model\EnvelopeSummary;
use DocuSign\eSign\Model\Recipients;
use DocuSign\eSign\Model\RecipientViewRequest;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\SignHere;
use DocuSign\eSign\Model\Tabs;
use DocuSign\eSign\Model\ViewUrl;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 *
 */
trait HasEnvelope
{

    /**
     * @var array
     */
    private $input_data = [ 'envelope_args' => [], 'files' => [] ];

    /**
     * @var array
     */
    private $recipients = [ ];

    /**
     * @var array
     */
    private $sign = [
        'anchor_string'   => 'Customer Signature', 'anchor_units' => 'pixels',
        'anchor_y_offset' => '-25', 'anchor_x_offset' => '5'
    ];

    private $embedded = false;

    private $return_url = null;

    private $doc_type = 'contract';

    /**
     * Freshly created envelope container
     * @var EnvelopeSummary
     */
    private $envelope_response;

    /**
     * @param $name
     * @param $email
     *
     * @return $this
     */
    public function setSigner( $name, $email )
    {
        $this->input_data[ 'envelope_args' ][ 'signer_email' ] = $email;
        $this->input_data[ 'envelope_args' ][ 'signer_name' ] = $name;
        return $this;
    }// setSigner

    /**
     * @param $name
     * @param $email
     *
     * @return $this
     */
    public function pushSigner( $recipients )
    {
        $this->recipients = $recipients;
        return $this;
    }// setSigner

    /**
     * @param $id
     *
     * @return $this
     */
    public function setContractId( $id )
    {
        $this->input_data[ 'contract_id' ] = $id;
        return $this;
    }// setContractId

    /**
     * @param $id
     *
     * @return $this
     */
    public function setDocType( $doc_type )
    {
        $this->doc_type = $doc_type;
        return $this;
    }// setContractId

    /**
     * @param $sign
     */
    public function setSign( $sign )
    {
        $this->sign = $sign;
        return $this;
    }// setSign

    /**
     * @param $return_url
     */
    public function setReturnUrl( $return_url )
    {
        $this->return_url = $return_url;
        return $this;
    }// setSign

    /**
     * @param $name
     * @param $email
     *
     * @return $this
     */
    public function setSignerCC( $name, $email )
    {
        $this->input_data[ 'envelope_args' ][ 'cc_email' ] = $email;
        $this->input_data[ 'envelope_args' ][ 'cc_name' ] = $name;
        return $this;
    }// setSignerCC

    /**
     *
     */
    public function setSubject( $subject )
    {
        $this->input_data[ 'email_subject' ] = $subject;
        return $this;
    }// setSubject

    /**
     * @param $file_path
     * @param null $title
     * @param int $id
     *
     * @return self
     * @throws FileNotFoundException
     */
    public function setDocument( $file_path, $title = null, int $id = 1 )
    {
        if( !file_exists( $file_path ) ) {
            throw new FileNotFoundException( $file_path . ' not found' );
        }
        $content = file_get_contents( $file_path );
        $extension = File::extension( $file_path );
        if( empty( $title ) ) {
            $title = basename( $file_path );
        }
        $this->input_data[ 'files' ][] = new Document( [
            'document_base64' => base64_encode( $content ),
            'name'            => $title,
            'file_extension'  => $extension,
            'document_id'     => $id,
        ] );

        return $this;
    }// setDocument

    /**
     * @throws ApiException
     */
    public function createEnvelope( $embedded = false )
    {
        //dd( $this->input_data[ 'files' ] );
        $this->embedded = $embedded;
        $envelope_definition = $this->doc_type == 'contract' ? $this->makeEnvelope() :  $this->makeSurveyEnvelope();
        $api = $this->getEnvelopeApi();

        $this->envelope_response = $api->createEnvelope( config( 'docusign.account_id' ), $envelope_definition );
        return $this;
    }// createEnvelope

    /**
     *
     * @throws ApiException
     */
    public function getEnvelope( $id ) : Envelope
    {
        $api = $this->getEnvelopeApi();
        return $api->getEnvelope( config( 'docusign.account_id' ), $id );
    }// getEnvelope

    /**
     * @return EnvelopeSummary
     */
    public function getEnvelopeResponse() : EnvelopeSummary
    {
        return $this->envelope_response;
    }

    /**
     * @return array
     */
    private function getArgs()
    {
        return [
            'envelope_args'   => $this->input_data[ 'envelope_args' ],
            'ds_access_token' => $this->getAccessToken(),
            'base_path'       => config( 'docusign.base_api_url' ),
            'account_id'      => config( 'docusign.account_id' ),
        ];
    }// getArgs

    /**
     * @return EnvelopeDefinition
     */
    private function makeEnvelope()
    {
        $envelope_definition = new EnvelopeDefinition( [
            'email_subject' => $this->input_data[ 'email_subject' ],
        ] );
        $envelope_definition->setAllowMarkup( true );

        $envelope_definition->setDocuments( $this->input_data[ 'files' ] );

        $recipients = [ 'signers' => [], 'carbon_copies' => [] ];

        $sign_here = new SignHere( $this->sign );

        $signer = new Signer( [
            'email'         => $this->input_data[ 'envelope_args' ][ 'signer_email' ],
            'name'          => $this->input_data[ 'envelope_args' ][ 'signer_name' ],
            'recipient_id'  => 1,
            'routing_order' => 1,
        ] );
        $signer->settabs( new Tabs( [ 'sign_here_tabs' => [ $sign_here ] ] ) );

        $recipients[ 'signers' ][] = $signer;

        if( !empty( $this->input_data[ 'envelope_args' ][ 'cc_email' ] ) ) {
            $recipients[ 'carbon_copies' ][] = new CarbonCopy( [
                'email'         => $this->input_data[ 'envelope_args' ][ 'cc_email' ],
                'name'          => $this->input_data[ 'envelope_args' ][ 'cc_name' ],
                'recipient_id'  => 2,
                'routing_order' => 2
            ] );
        }

        $recipients = new Recipients( $recipients );

        $envelope_definition->setRecipients( $recipients );
        $envelope_definition->setStatus( 'sent' );
        return $envelope_definition;
    }

    /**
     * @return EnvelopeDefinition
     */
    private function makeSurveyEnvelope()
    {
        $envelope_definition = new EnvelopeDefinition( [
            'email_subject' => $this->input_data[ 'email_subject' ],
        ] );
        $envelope_definition->setAllowMarkup( true );

        $envelope_definition->setDocuments( $this->input_data[ 'files' ] );

        $recipients = [ 'signers' => [], 'carbon_copies' => [] ];

        foreach($this->recipients as $recipient){

            $sign_here = new SignHere( $recipient['sign'] );

            $signer = new Signer( [
                'email'         => $recipient[ 'signer_email' ],
                'name'          => $recipient[ 'signer_name' ],
                'recipient_id'  => rand(1,999),
                'routing_order' => rand(1,999),
            ] );
            $signer->settabs( new Tabs( [ 'sign_here_tabs' => [ $sign_here ] ] ) );

            $recipients[ 'signers' ][] = $signer;
        }
           
        if( !empty( $this->input_data[ 'envelope_args' ][ 'cc_email' ] ) ) {
            $recipients[ 'carbon_copies' ][] = new CarbonCopy( [
                'email'         => $this->input_data[ 'envelope_args' ][ 'cc_email' ],
                'name'          => $this->input_data[ 'envelope_args' ][ 'cc_name' ],
                'recipient_id'  => 2,
                'routing_order' => 2
            ] );
        }

        $recipients = new Recipients( $recipients );

        $envelope_definition->setRecipients( $recipients );
        $envelope_definition->setStatus( 'sent' );
        return $envelope_definition;
    }

    /**
     *
     */
    public function setEmbeddedSigning()
    {
        $this->embedded = true;
    }

    /**
     * @throws ApiException
     */
    public function generateEmbeddedSignature() : ViewUrl
    {
        $req = new RecipientViewRequest( [
            'authentication_method' => 'None',
            //'client_user_id'        => 100,
            //'recipient_id'          => 1,
            'return_url'            => $this->return_url != null ?  $this->return_url : route( 'admin.contracts.signed', $this->input_data[ 'contract_id' ] ),
            'user_name'             => $this->input_data[ 'envelope_args' ][ 'signer_name' ], 'email' => $this->input_data[ 'envelope_args' ][ 'signer_email' ]
        ] );
        $api = $this->getEnvelopeApi();
        $account_id = config( 'docusign.account_id' );
        $envelope_id = $this->envelope_response->getEnvelopeId();
        return $api->createRecipientView( $account_id, $envelope_id, $req );
    }// generateEmbeddedSignature

    /**
     * @param $envelope_id
     *
     * @return EnvelopeDocumentsResult
     * @throws ApiException
     */
    public function listDocuments( $envelope_id ) : EnvelopeDocumentsResult
    {
        $api = $this->getEnvelopeApi();
        return $api->listDocuments( config( 'docusign.account_id' ), $envelope_id );
    }

    /**
     * @param $envelope_id
     *
     * @return EnvelopeDocument
     * @throws ApiException
     */
    public function getFirstDocument( $envelope_id )
    {
        $list = $this->listDocuments( $envelope_id );
        $docs = $list->getEnvelopeDocuments();
        return $docs[ 0 ];
    }

    /**
     * @param $document_id
     * @param $envelope_id
     *
     * @return \SplFileObject
     * @throws ApiException
     */
    public function getDocument( $document_id, $envelope_id )
    {
        $api = $this->getEnvelopeApi();
        return $api->getDocument( config( 'docusign.account_id' ), $document_id, $envelope_id );
    }

}// HasEnvelope
