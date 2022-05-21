<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Theme;
use App\Http\Controllers\Controller;
use App\Services\PestPacService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 *
 */
class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return Theme::view( 'dashboard.index' );
    }// index

}// DashboardController
