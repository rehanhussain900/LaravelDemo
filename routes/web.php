<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Select2Controller;
use App\Http\Controllers\Socialite\AzureAuthController;
use App\Http\Controllers\Socialite\DocuSignAuthController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* --------------------------------------------------------------
 *  Azure
 * --------------------------------------------------------------
 */
Route::get( '/auth/redirect', [ AzureAuthController::class, 'index' ] )->name( 'login.azure' );
Route::get( '/auth/callback', [ AzureAuthController::class, 'authenticate' ] )
     ->name( 'login.azure.redirect' );

/* --------------------------------------------------------------
 *  DocuSign Login
 * --------------------------------------------------------------
 */
Route::get( '/auth/docusign', [ DocuSignAuthController::class, 'authenticate' ] )
     ->name( 'auth.docusign.back' );

Route::redirect( '/', 'admin' );

/* --------------------------------------------------------------
 *  Path to Files for Authentic users
 * --------------------------------------------------------------
 */
Route::middleware( [ 'web', 'auth:sanctum', 'verified', 'dashboard' ] )->group( function() {
    Route::get( 'files/download/{filename}', [ SettingsController::class, 'downloadFile' ] )
         ->name( 'file.download' )
         ->where( 'filename', '.*' );
    Route::get( 'files/{filename}', [ SettingsController::class, 'accessFiles' ] )
         ->name( 'file.open' )
         ->where( 'filename', '.*' );
} );// files Route

/* --------------------------------------------------------------
 *  Select 2
 * --------------------------------------------------------------
 */
Route::middleware( [ 'web', 'auth:sanctum' ] )->prefix( 'select2' )->group( static function() {
    Route::patch( 'cities', [ Select2Controller::class, 'cities' ] )
         ->name( 'select2.cities' );
    Route::patch( 'states', [ Select2Controller::class, 'states' ] )
         ->name( 'select2.states' );
} );


/* --------------------------------------------------------------
 *  Test Routes
 * --------------------------------------------------------------
 */
Route::prefix( 'test' )->group( function() {
    Route::get( '/getServiceOrders', [ TestController::class, 'getServiceOrders' ] );
    Route::get( '/', [ TestController::class, 'index' ] );
    Route::view( '/template', 'admin.layouts.pdf' );
    Route::get( '/pdf', [ TestController::class, 'pdf' ] );
} );
