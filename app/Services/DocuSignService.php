<?php

namespace App\Services;

use App\Traits\DocuSignAuthenticable;
use App\Traits\HasEnvelope;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Client\Auth\UserInfo;
use DocuSign\eSign\Configuration;

/**
 *
 */
class DocuSignService
{
    use DocuSignAuthenticable, HasEnvelope;

    /**
     * @var
     */
    private $apiClient;

    /**
     * @return EnvelopesApi
     */
    public function getEnvelopeApi()
    {
        $config = new Configuration();
        $config->setHost( config( 'docusign.base_api_url' ) );
        $token = 'Bearer ' . $this->getAccessToken();
        $config->addDefaultHeader( 'Authorization', $token );
        $this->apiClient = new ApiClient( $config );
        return new EnvelopesApi( $this->apiClient );
    }

    /**
     * @return UserInfo
     * @throws ApiException
     */
    public function getUserInfo()
    {
        $response = $this->authClient->getUserInfo( $this->getAccessToken() );
        return $response[ 0 ];
    }

    /**
     * @return EnvelopesApi
     */
    public function sendToMultipleRecipent()
    {
        $config = new Configuration();
        $config->setHost( config( 'docusign.base_api_url' ) );
        $token = 'Bearer ' . $this->getAccessToken();
        $config->addDefaultHeader( 'Authorization', $token );
        $this->apiClient = new ApiClient( $config );
        return new EnvelopesApi( $this->apiClient );
    }
}// DocuSignService