<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\PestPacBranch;

class BranchAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = PestPacBranch::where('active' , 1)->get(['id', 'branch_id', 'name']);
        return new JsonResponse( [ 'message' => '', 'status' => 1, 'data' =>  $branches ], 200 );
    }
}
