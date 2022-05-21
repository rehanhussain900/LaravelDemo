<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Microsoft\Graph\Exception\GraphException;
use Microsoft\Graph\Graph;

/**
 *
 */
class MicrosoftGraphService
{
    private $token;

    private $graph;

    public function __construct()
    {
        $this->graph = new Graph();
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function authenticate()
    {
        $token = option( 'ms.graph.token' );
        $expiry = option( 'ms.graph.expiry' );
        if( !empty( $expiry ) && !empty( $token ) && $expiry > time() ) {
            $this->token = $token;
            return $this->token;
        }
        $guzzle = new Client();
        $url = 'https://login.microsoftonline.com/' . config( 'services.azure.tenant' ) . '/oauth2/token?api-version=1.0';
        $scopes = [
            'https://graph.microsoft.com/.default',
            'https://graph.microsoft.com/User.Read.All',
            'https://graph.microsoft.com/Directory.Read.All',
            'https://graph.microsoft.com/Directory.ReadWrite.All',
        ];
        $token = json_decode( $guzzle->post( $url, [
            'form_params' => [
                'client_id'     => config( 'services.azure.client_id' ),
                'client_secret' => config( 'services.azure.client_secret' ),
                'resource'      => 'https://graph.microsoft.com/',
                'grant_type'    => 'client_credentials',
                'scope'         => 'https://graph.microsoft.com/.default',
            ],
        ] )->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR );
        $this->token = $token->access_token;
        $expire_on = $token->expires_on;
        option( [ 'ms.graph.token' => $this->token, 'ms.graph.expiry' => $expire_on ] );
        return $this->token;
    }// authenticate

    /**
     * @throws GraphException
     * @throws GuzzleException
     */
    public function getUser()
    {
        $this->graph->setAccessToken( $this->token );
        $user = $this->graph->createRequest( "GET", "/users" )
                            ->setReturnType( User::class )
                            ->execute();
        return $user;
    }


}// MicrosoftGraphService
