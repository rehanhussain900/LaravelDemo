<?php

namespace App\Services\PestPac;

use App\Services\PestPacService;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use function PHPUnit\Framework\fileExists;

/**
 *
 */
class Document
{
    public const DOCUMENT_TYPE_COMPANY_DOCUMENT   = 'CompanyDocument';
    public const DOCUMENT_TYPE_LOCATION_DOCUMENT  = 'LocationDocument';
    public const DOCUMENT_TYPE_FORM               = 'Form';
    public const DOCUMENT_TYPE_CALL_DOCUMENT      = 'CallDocument';
    public const DOCUMENT_TYPE_LEAD_DOCUMENT      = 'LeadDocument';
    public const DOCUMENT_TYPE_MATERIAL_DOCUMENT  = 'MaterialDocument';
    public const DOCUMENT_TYPE_EMPLOYEE_DOCUMENT  = 'EmployeeDocument';
    public const DOCUMENT_TYPE_CONDITION_DOCUMENT = 'ConditionDocument';
    /**
     * @var array
     */
    private $input = [];

    /**
     * @var Client
     */
    private $client;

    private $defaults;

    /**
     * @param PestPacService $service
     */
    public function __construct( PestPacService $service )
    {
        $this->client = $service->getGuzzleClient();
        $this->defaults = $service->getDefaultOptions();
    }// __construct

    /**
     * @return string
     * @throws GuzzleException
     */
    public function getByID( $id, $type )
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $this->defaults[ 'query' ] = [ 'type' => $type ];
        $response = $this->client->request( 'GET', 'documents/' . $id, $this->defaults );
        return $response->getBody()->getContents();
    }// getByID

    /**
     * @param $id
     * @param $type
     *
     * @return string
     * @throws GuzzleException
     */
    public function deleteById( $id, $type )
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $this->defaults[ 'query' ] = [ 'type' => $type ];
        $response = $this->client->request( 'DELETE', 'documents/' . $id, $this->defaults );
        return $response->getBody()->getContents();
    }// deleteById

    /**
     * @param $id
     * @param $type
     *
     * @return string
     * @throws GuzzleException
     */
    public function downloadById( $id, $type )
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $this->defaults[ 'query' ] = [ 'type' => $type ];
        $response = $this->client->request( 'GET', 'documents/' . $id . '/download', $this->defaults );
        $content_type = $response->getHeader( 'content-type' )[ 0 ];
        return Response( $response->getBody()->getContents(), 200, [ 'Content-Type' => $content_type ] );
    }// downloadById

    /**
     * @param $type
     *
     * @return ResponseInterface
     * @throws GuzzleException|\JsonException
     */
    public function create()
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $this->defaults[ 'query' ] = [ 'type' => $this->input[ 'document_type' ] ];
        $this->defaults[ 'body' ] = json_encode( $this->input, JSON_THROW_ON_ERROR );
        return $this->client->request( 'POST', 'documents/', $this->defaults );
    }// create

    /**
     * @param $id
     * @param $type
     * @param $file
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function upload( $id, $type, $file )
    {
        $this->defaults[ 'query' ] = [ 'type' => $type ];
        $this->defaults[ 'multipart' ] = [
            [
                'name'     => 'file',
                'contents' => Utils::tryFopen( $file, 'r' ),
            ],
        ];
        return $this->client->request( 'POST', 'documents/' . $id . '/upload', $this->defaults );
    }// upload

    /**
     * Gets document_type
     * @return string
     */
    public function getDocumentType()
    {
        return $this->input[ 'document_type' ];
    }

    /**
     * Sets document_type
     *
     * @param string $document_type
     *
     * @return $this
     */
    public function setDocumentType( $document_type ) : Document
    {
        $allowed_values = [ 'CompanyDocument', 'LocationDocument', 'Form', 'CallDocument', 'LeadDocument', 'MaterialDocument', 'EmployeeDocument', 'ConditionDocument' ];
        if( !in_array( $document_type, $allowed_values ) ) {
            throw new InvalidArgumentException( "Invalid value for 'document_type', must be one of 'CompanyDocument', 'LocationDocument', 'Form', 'CallDocument', 'LeadDocument', 'MaterialDocument', 'EmployeeDocument', 'ConditionDocument'" );
        }
        $this->input[ 'document_type' ] = $document_type;

        return $this;
    }

    /**
     * Gets document_id
     * @return int
     */
    public function getDocumentId() : int
    {
        return $this->input[ 'document_id' ];
    }

    /**
     * Sets document_id
     *
     * @param int $document_id
     *
     * @return $this
     */
    public function setDocumentId( $document_id ) : Document
    {
        $this->input[ 'document_id' ] = $document_id;

        return $this;
    }

    /**
     * Gets name
     * @return string
     */
    public function getName() : string
    {
        return $this->input[ 'name' ];
    }

    /**
     * Sets name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName( string $name ) : Document
    {
        $this->input[ 'name' ] = $name;

        return $this;
    }

    /**
     * Gets date
     * @return DateTime
     */
    public function getDate()
    {
        return $this->input[ 'date' ];
    }

    /**
     * Sets date
     *
     * @param string $date
     *
     * @return $this
     */
    public function setDate( $date )
    {
        $this->input[ 'date' ] = $date;

        return $this;
    }

    /**
     * Gets file_name
     * @return string
     */
    public function getFileName()
    {
        return $this->input[ 'file_name' ];
    }

    /**
     * Sets file_name
     *
     * @param string $file_name
     *
     * @return $this
     */
    public function setFileName( $file_name )
    {
        $this->input[ 'file_name' ] = $file_name;

        return $this;
    }

    /**
     * Gets url
     * @return string
     */
    public function getUrl()
    {
        return $this->input[ 'url' ];
    }

    /**
     * Sets url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl( $url )
    {
        $this->input[ 'url' ] = $url;

        return $this;
    }

    /**
     * Gets tags
     * @return string
     */
    public function getTags()
    {
        return $this->input[ 'tags' ];
    }

    /**
     * Sets tags
     *
     * @param string $tags
     *
     * @return $this
     */
    public function setTags( $tags )
    {
        $this->input[ 'tags' ] = $tags;

        return $this;
    }

    /**
     * Gets include_on
     * @return IncludeDocumentOn
     */
    public function getIncludeOn()
    {
        return $this->input[ 'include_on' ];
    }

    /**
     * Sets include_on
     *
     * @param IncludeDocumentOn $include_on
     *
     * @return $this
     */
    public function setIncludeOn( $include_on )
    {
        $this->input[ 'include_on' ] = $include_on;

        return $this;
    }

    /**
     * Gets starting_effective_date
     * @return DateTime
     */
    public function getStartingEffectiveDate()
    {
        return $this->input[ 'starting_effective_date' ];
    }

    /**
     * Sets starting_effective_date
     *
     * @param DateTime $starting_effective_date
     *
     * @return $this
     */
    public function setStartingEffectiveDate( $starting_effective_date )
    {
        $this->input[ 'starting_effective_date' ] = $starting_effective_date;

        return $this;
    }

    /**
     * Gets ending_effective_date
     * @return DateTime
     */
    public function getEndingEffectiveDate()
    {
        return $this->input[ 'ending_effective_date' ];
    }

    /**
     * Sets ending_effective_date
     *
     * @param DateTime $ending_effective_date
     *
     * @return $this
     */
    public function setEndingEffectiveDate( $ending_effective_date )
    {
        $this->input[ 'ending_effective_date' ] = $ending_effective_date;

        return $this;
    }

    /**
     * Gets form_data
     * @return string
     */
    public function getFormData()
    {
        return $this->input[ 'form_data' ];
    }

    /**
     * Sets form_data
     *
     * @param string $form_data
     *
     * @return $this
     */
    public function setFormData( $form_data )
    {
        $this->input[ 'form_data' ] = $form_data;

        return $this;
    }

    /**
     * Gets order_id
     * @return int
     */
    public function getOrderId()
    {
        return $this->input[ 'order_id' ];
    }

    /**
     * Sets order_id
     *
     * @param int $order_id
     *
     * @return $this
     */
    public function setOrderId( $order_id )
    {
        $this->input[ 'order_id' ] = $order_id;

        return $this;
    }

    /**
     * Gets is_tech_photo
     * @return bool
     */
    public function getIsTechPhoto()
    {
        return $this->input[ 'is_tech_photo' ];
    }

    /**
     * Sets is_tech_photo
     *
     * @param bool $is_tech_photo
     *
     * @return $this
     */
    public function setIsTechPhoto( $is_tech_photo )
    {
        $this->input[ 'is_tech_photo' ] = $is_tech_photo;

        return $this;
    }

    /**
     * Gets setup_id
     * @return int
     */
    public function getSetupId()
    {
        return $this->input[ 'setup_id' ];
    }

    /**
     * Sets setup_id
     *
     * @param int $setup_id
     *
     * @return $this
     */
    public function setSetupId( $setup_id )
    {
        $this->input[ 'setup_id' ] = $setup_id;

        return $this;
    }

    public function setFieldValue( $key, $val )
    {
        $this->input[ $key ] = $val;
        return $this;
    }
}