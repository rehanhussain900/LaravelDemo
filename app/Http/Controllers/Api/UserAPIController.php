<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;

class UserAPIController extends Controller
{
    private $service;

    /**
     *
     */
    public function __construct( UserService $service )
    {
        $this->service = $service;
    }

    /**
     * get technnicians 
     */
    public function getTechnicians()
    {
       
        try{
            $data =  $this->service->getUserByRole('Technician');
            if($data){
                return new JsonResponse( [ 'message' => '', 'status' => 1, 'data' => $data  ], 200 );
            }
            return new JsonResponse( [ 'message' => 'Something went wrong' , 'status' => 0, 'data' => '' ], 200 );
        }
        catch(\Exception $e){
            return new JsonResponse( [ 'message' => $e->getMessage() , 'status' => 0, 'data' => '' ], 200 );
        }
    }
}
