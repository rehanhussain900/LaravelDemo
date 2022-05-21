<?php

namespace App\Traits;

use GuzzleHttp\Exception\GuzzleException;

trait PestPacAuthenticable
{
    private $token;

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function authenticate()
    {
        if( !$this->hasToken() ) {
            $token = $this->fetchToken();
            $token = json_decode( $token, false, 512, JSON_THROW_ON_ERROR );
            $this->token = $token->access_token;

            $meta = [
                'pest_pac_token_expire'  => time() + ( $token->expires_in - 180 ),
                'pest_pac_refresh_token' => $token->refresh_token,
                'pest_pac_id_token'      => $token->id_token,
                'pest_pac_access_token'  => $token->access_token,
            ];
            option( $meta );
        }

        $this->default_options = [
            'headers' => [
                'Accept'        => 'application/json',
                'Apikey'        => $this->credentials[ 'api_key' ],
                'tenant-id'     => $this->credentials[ 'company_id' ],
                'Authorization' => 'Bearer ' . $this->token,
            ]
        ];

    }// authenticate

    /**
     * @throws GuzzleException
     */
    public function fetchToken()
    {
        $url = 'https://is.workwave.com/oauth2/token?scope=openid';
        $options = [
            'auth'        => [ $this->credentials[ 'client_id' ], $this->credentials[ 'client_secret' ] ],
            'form_params' => [
                'grant_type' => 'password',
                'username'   => $this->credentials[ 'username' ],
                'password'   => $this->credentials[ 'password' ],
            ]
        ];
        $response = $this->client->request( 'POST', $url, $options );
        return $response->getBody()->getContents();
    }// authenticate

    /**
     *
     */
    private function refreshToken()
    {

    }

    /**
     * @return bool
     */
    private function hasToken()
    {
        $token = option( 'pest_pac_access_token' );
        $expiry = option( 'pest_pac_token_expire' );
        if( empty( $token ) || empty( $expiry ) ) {
            return false;
        }
        if( time() > $expiry ) {
            return false;
        }

        $this->token = $token;

        return true;
    }
}