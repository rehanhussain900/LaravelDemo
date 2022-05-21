<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Services\DocuSignService;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

class DocuSignAuthController extends Controller
{
    private $service;

    /**
     *
     */
    public function __construct( DocuSignService $service )
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @throws FileNotFoundException
     */
    public function authenticate( Request $request )
    {
        $this->service->authenticate();
    }
}
