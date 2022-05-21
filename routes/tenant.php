<?php

declare( strict_types = 1 );

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

/* --------------------------------------------------------------
 *  API Routes
 * --------------------------------------------------------------
 */
Route::prefix( 'api' )
     ->middleware( [ 'api' ] )
     ->group( base_path( 'routes/api.php' ) );

/* --------------------------------------------------------------
 *  Web Routes
 * --------------------------------------------------------------
 */
Route::middleware( [ 'web' ] )
     ->group( base_path( 'routes/web.php' ) );

/* --------------------------------------------------------------
 *  Admin Routes
 * --------------------------------------------------------------
 */
Route::prefix( 'admin' )
     ->middleware( [ 'web', 'auth:sanctum', 'verified', 'dashboard' ] )
     ->group( base_path( 'routes/admin.php' ) );
