<?php

namespace App\Http\Middleware;

use App\Helpers\Theme;
use Closure;
use Illuminate\Http\Request;

class DashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle( Request $request, Closure $next )
    {
        Theme::setTheme( 'admin' );
        return $next( $request );
    }
}
