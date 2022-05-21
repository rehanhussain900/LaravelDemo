<?php

/* --------------------------------------------------------------
 *  These routes will only be used on the primary domain
 * --------------------------------------------------------------
 */

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get( 'test', function() {
    App\Models\Tenant::all()->runForEach( function() {
        Artisan::call( 'db:seed' );
    } );
} );
