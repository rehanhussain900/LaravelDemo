<?php

namespace App\Services;

use App\Traits\PestPacAuthenticable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 *
 */
class PestPacService
{
    use PestPacAuthenticable;

    /**
     * @var array
     */
    private $credentials;

    private $client;


    private $base_url;

    private $default_options; 

    /**
     *
     */
    public function __construct()
    {
        $this->credentials = [
            'username'      => env( 'PESTPAC_USERNAME' ),
            'password'      => env( 'PESTPAC_PASSWORD' ),
            'client_id'     => env( 'PESTPAC_CLIENT_ID' ),
            'client_secret' => env( 'PESTPAC_CLIENT_SECRET' ),
            'api_key'       => env( 'PESTPAC_API_KEY' ),
            'company_id'    => env( 'PESTPAC_COMPANY_ID' ),
        ];

        $this->base_url = env( 'PESTPAC_BASE_URL' );

        $this->client = new Client( [ 'base_uri' => $this->base_url ] );
    }// __construct


    /**
     * @throws GuzzleException
     */
    public function getBranches()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/branches', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( \Exception $e ) {

        }
        return false;
    }// getBranches

    /**
     * @return false|string
     * @throws GuzzleException
     */
    public function getConditions()
    {
        $response = $this->client->request( 'GET', 'lookups/conditions', $this->default_options );
        return $response->getBody()->getContents();
    }// getConditions

    /**
     * @return false|string
     * @throws GuzzleException
     */
    public function getEmployees()
    {
        $response = $this->client->request( 'GET', 'lookups/employees', $this->default_options );
        return $response->getBody()->getContents();
    }// getEmployees

    /**
     * @return false|string
     * @throws GuzzleException
     */
    public function getFrequencies()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/frequencies', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( \Exception $e ) {

        }
        return false;
    }// getFrequencies

    /**
     * @return false|string
     * @throws GuzzleException
     */
    public function getLocationAreaTypes()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/locationAreaTypes', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( \Exception $e ) {

        }
        return false;
    }// getLocationAreaTypes

    /**
     * @return false|string
     * @throws GuzzleException
     */
    public function getMaterials()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/locationAreaTypes', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( \Exception $e ) {

        }
        return false;
    }// getMaterials

    /**
     * @return false|string
     */
    public function getNoteCodes()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/noteCodes', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( GuzzleException $e ) {

        }
        return false;
    }// getNoteCodes

    /**
     * @return false|string
     */
    public function getSchedules()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/schedules', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( GuzzleException $e ) {

        }
        return false;
    }// getSchedules

    /**
     * @return false|string
     */
    public function getServiceClasses()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/serviceClasses', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( GuzzleException $e ) {

        }
        return false;
    }// getServiceClasses

    /**
     * @return false|string
     */
    public function getServices()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/services', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( GuzzleException $e ) {

        }
        return false;
    }// getServices

    /**
     * @return false|string
     */
    public function getSources()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/sources', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( GuzzleException $e ) {

        }
        return false;
    }// getSources

    /**
     * @return false|string
     */
    public function getTargetPests()
    {
        try {
            $response = $this->client->request( 'GET', 'lookups/targetPests', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( GuzzleException $e ) {

        }
        return false;
    }// getTargetPests

    /**
     * @param $params
     *      <b>branch</b>
     *      <b>code</b>
     *      <b>description</b>
     *      <b>date</b> (optional)
     *
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function logActivity( $params )
    {
        $request = \request();
        $this->default_options[ 'body' ] = json_encode( [
            'branch'      => $params[ 'branch' ],
            'code'        => $params[ 'code' ],
            'description' => $params[ 'description' ],
            'date'        => $params[ 'date' ] ?? date( 'Y-m-d' ),
            'ip_address'  => $request->ip(),
            'url'         => $request->fullUrl(),
            'user_agent'  => $request->userAgent()
        ], JSON_THROW_ON_ERROR );
        $this->default_options[ 'headers' ][ 'Content-Type' ] = 'application/json';
        return $this->client->request( 'POST', 'activityLog', $this->default_options );
    }

    /**
     * @return false|string
     */
    public function getServiceOrders()
    {
        try {
            $response = $this->client->request( 'GET', '/ServiceOrders', $this->default_options );
            return $response->getBody()->getContents();
        } catch ( GuzzleException $e ) {

        }
        return false;
    }// getTargetPests

    /**
     * @return Client
     */
    public function getGuzzleClient() : Client
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getDefaultOptions()
    {
        return $this->default_options;
    }

}// PestPacService
