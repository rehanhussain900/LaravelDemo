<?php

namespace App\Services\PestPac;

use App\Services\PestPacService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 *
 */
class BillTo
{

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
     * @param $id
     *
     * @return $this
     */
    public function setID( $id )
    {
        $this->input[ 'BillToID' ] = $id;
        return $this;
    }// setID

    /**
     * @return string
     * @throws GuzzleException
     */
    public function getByID( $id )
    {
        $response = $this->client->request( 'GET', 'billTos/' . $id, $this->defaults );
        return $response->getBody()->getContents();
    }// billTos

    /**
     * @param $q
     *
     * @return string
     * @throws GuzzleException
     */
    public function getByQuery( $q )
    {

        $this->defaults[ 'query' ] = [ 'q' => $q ];
        $response = $this->client->request( 'GET', 'billTos', $this->defaults );
        return $response->getBody()->getContents();
    }// getByQuery

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function create()
    {
        $this->defaults[ 'body' ] = json_encode( [
            "BillToCode"     => "576760",
            "Branch"         => "Charleston 25-0706",
            "BranchID"       => 200706,
            "Company"        => "",
            "LastName"       => "Tim",
            "FirstName"      => "Test",
            "Address"        => "759 Bradburn Dr",
            "Address2"       => "",
            "City"           => "Mount Pleasant",
            "State"          => "SC",
            "Zip"            => "29464-5114",
            "Phone"          => "843-884-0430",
            "AlternatePhone" => "",
            "MobilePhone"    => "",
            "Email"          => "test@pestpac.com",
            "Type"           => "R",
            'EnteredDate'    => date( 'Y-m-d' ),
        ], JSON_THROW_ON_ERROR );

        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'POST', 'billTos', $this->defaults );
        return $response->getBody()->getContents();
    }

}// BillTo
