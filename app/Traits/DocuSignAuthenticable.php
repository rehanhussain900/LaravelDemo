<?php

namespace App\Traits;

use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Configuration;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

trait DocuSignAuthenticable
{
    private $authClient;

    /**
     * @var
     */
    private $accessToken;

    /**
     */
    public function __construct()
    {
        $config = new Configuration();
        $this->authClient = new ApiClient( $config );
        $this->authClient->getOAuth()->setOAuthBasePath( config( 'docusign.auth_server' ) );
    }

    /**
     * @throws FileNotFoundException
     */
    public function authenticate()
    {
        if( !$this->isTokenAlive() ) {
            $this->generateAuthToken();
        }

    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }// getAccessToken

    /**
     * @return bool
     */
    private function isTokenAlive() : bool
    {
        $docu_token = Session::get( '_ds__token', [] );
        if( empty( $docu_token[ 'access_token' ] ) || empty( $docu_token[ 'expires_in' ] ) ) {
            return false;
        }

        if( time() > $docu_token[ 'expires_in' ] ) {
            return false;
        }

        $this->accessToken = $docu_token[ 'access_token' ];

        return true;
    }// isTokenAlive

    /**
     * @return bool
     * @throws FileNotFoundException
     * @throws ApiException
     */
    private function generateAuthToken() : bool
    {
        $jwt_scope = "signature impersonation";
        $client_id = config( 'docusign.client_id' );
        $key_path = Storage::disk( 'private' )->get( config( 'docusign.private_key' ) );
        try {
            $response = $this->authClient->requestJWTUserToken(
                $client_id,
                config( 'docusign.user_id' ),
                $key_path,
                $jwt_scope,
            );

            $oauth_token = $response[ 0 ];
            $session_data = [
                'access_token'  => $oauth_token->getAccessToken(),
                'refresh_token' => $oauth_token->getRefreshToken(),
                'expires_in'    => time() + $oauth_token->getExpiresIn(),
            ];
            $this->accessToken = $session_data[ 'access_token' ];
            Session::put( '_ds__token', $session_data );
            return true;
        } catch ( Throwable $th ) {
            // we found consent_required in the response body meaning first time consent is needed
            if( strpos( $th->getMessage(), "consent_required" ) !== false ) {
                $_SESSION[ 'consent_set' ] = true;
                $authorizationURL = 'https://account-d.docusign.com/oauth/auth?' . http_build_query( [
                        'scope'         => $jwt_scope,
                        'redirect_uri'  => route( 'auth.docusign.back' ),
                        'client_id'     => $client_id,
                        'state'         => null,
                        'response_type' => 'code'
                    ] );
                header( 'Location: ' . $authorizationURL );
                exit();
            }// if(consent_required)
        }// catch
        return false;
    }// getAuthToken
}