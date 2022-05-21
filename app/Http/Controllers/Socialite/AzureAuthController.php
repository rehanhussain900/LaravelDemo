<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Services\AzureAuthService;
use Illuminate\Http\Request;

/**
 *
 */
class AzureAuthController extends Controller
{
    private $service;

    public function __construct( AzureAuthService $service )
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->execute();
    }

    public function authenticate(){
        return $this->service->authenticate();
    }


}
