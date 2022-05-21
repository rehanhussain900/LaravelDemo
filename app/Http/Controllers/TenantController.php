<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Features\UserImpersonation;
use function route;

/**
 *
 */
class TenantController extends Controller
{

    /**
     * @param $token
     *
     * @return RedirectResponse
     */
    public function impersonate( $token )
    {
        return UserImpersonation::makeResponse( $token );

    }// impersonate

    public function token()
    {
        $redirectUrl = '/admin';
        $tenant = Tenant::where( 'id', '!=', tenant( 'id' ) )->first();
        $token = tenancy()->impersonate( tenant(), Auth::id(), $redirectUrl );
        return '<a href="' . route( 'tenant.impersonate', $token ) . '">Impersonate</a>';

    }

}// TenantController
