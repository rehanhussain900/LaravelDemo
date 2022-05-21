<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class TenantInit
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle() : void
    {
        try {
            Config::set( 'services.azure.redirect', route( 'login.azure.redirect' ) );
            Config::set( 'app.name', option( 'app.name' ) );
        } catch ( \Exception $e ) {
            Log::error( $e->getMessage(), $e->getTrace() );
        }
    }
}
