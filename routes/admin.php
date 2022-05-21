<?php

use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DailyProductionReportController;
use App\Http\Controllers\Admin\QualityAssuranceSurveyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocuSignController;
use App\Http\Controllers\Admin\MiscDepositController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get( '/', [ DashboardController::class, 'index' ] )
     ->name( 'dashboard' )
     ->middleware( 'can:access dashboard' );

/* --------------------------------------------------------------
 *  Roles
 * --------------------------------------------------------------
 */
Route::prefix( 'roles' )->group( static function() {
    Route::get( '/', [ RoleController::class, 'index' ] )
         ->name( 'admin.roles' )
         ->middleware( 'can:access roles' );

    Route::post( '/', [ RoleController::class, 'store' ] )
         ->name( 'admin.roles.create' )
         ->middleware( 'can:add role' );

    Route::patch( '/{role}', [ RoleController::class, 'edit' ] )
         ->name( 'admin.roles.edit' )
         ->middleware( 'can:edit role' );
    Route::put( '/{role}', [ RoleController::class, 'update' ] )
         ->name( 'admin.roles.edit' )
         ->middleware( 'can:edit role' );

    Route::delete( '/{role}', [ RoleController::class, 'destroy' ] )
         ->name( 'admin.roles.delete' )
         ->middleware( 'can:delete role' );
} );

/* --------------------------------------------------------------
 *  Users
 * --------------------------------------------------------------
 */
Route::prefix( 'users' )->group( static function() {
    Route::get( '/', [ UserController::class, 'index' ] )
         ->name( 'admin.users' )
         ->middleware( 'can:access users' );

    Route::post( '/', [ UserController::class, 'store' ] )
         ->name( 'admin.users.create' )
         ->middleware( 'can:add user' );

    Route::get( 'profile', [ UserController::class, 'show' ] )
         ->name( 'admin.users.profile' )
         ->middleware( 'can:edit own profile' );

    Route::post( 'profile', [ UserController::class, 'updateProfile' ] )
         ->name( 'admin.users.profile' )
         ->middleware( 'can:edit own profile' );

    Route::patch( '/{user}', [ UserController::class, 'edit' ] )
         ->name( 'admin.users.edit' )
         ->middleware( 'can:edit user' );

    Route::put( '/{user}', [ UserController::class, 'update' ] )
         ->name( 'admin.users.edit' )
         ->middleware( 'can:edit user' );

    Route::delete( '/{user}', [ UserController::class, 'destroy' ] )
         ->name( 'admin.users.delete' )
         ->middleware( 'can:delete user' );
} );// users


/* --------------------------------------------------------------
 *  Contracts
 * --------------------------------------------------------------
 */
Route::prefix( 'contracts' )->group( function() {
    Route::get( '/', [ ContractController::class, 'index' ] )
         ->name( 'admin.contracts' )
         ->middleware( 'can:access contracts' );
    Route::get( '/new', [ ContractController::class, 'create' ] )
         ->name( 'admin.contracts.create' )
         ->middleware( 'can:add contract' );
    Route::post( '/new/segments', [ ContractController::class, 'storeSegments' ] )
         ->name( 'admin.contracts.store_segment' )
         ->middleware( 'can:add contract' );
    Route::post( '/new/customer-info', [ ContractController::class, 'storeCustomerInfo' ] )
         ->name( 'admin.contracts.store_customer_info' )
         ->middleware( 'can:add contract' );
    Route::post( '/new/services', [ ContractController::class, 'storeServices' ] )
         ->name( 'admin.contracts.store_services' )
         ->middleware( 'can:add contract' );
    Route::post( '/confirm', [ ContractController::class, 'confirm' ] )
         ->name( 'admin.contracts.confirm' )
         ->middleware( 'can:add contract' );
    Route::get( '/preview', [ ContractController::class, 'preview' ] )
         ->name( 'admin.contracts.preview' )
         ->middleware( 'can:add contract' );
    Route::post( '/sign', [ ContractController::class, 'sign' ] )
         ->name( 'admin.contracts.sign' )
         ->middleware( 'can:add contract' );
    Route::get( '/signed/{contract?}', [ ContractController::class, 'signed' ] )
         ->name( 'admin.contracts.signed' )
         ->middleware( 'can:add contract' );
    Route::get( '/send/{contract}', [ ContractController::class, 'send' ] )
         ->name( 'admin.contracts.send' )
         ->middleware( 'can:access contracts' );
    Route::post( '/assign/{contract}', [ ContractController::class, 'assignContarct' ] )
         ->name( 'admin.contracts.assign' )
         ->middleware( 'can:assign contracts' );
    Route::get( '/assign/{contract}', [ ContractController::class, 'assign' ] )
         ->name( 'admin.contracts.assign' )
         ->middleware( 'can:assign contracts' );
    Route::get( '/download/{contract}', [ DocuSignController::class, 'download' ] )
         ->name( 'admin.contracts.download' )
         ->middleware( 'can:access contracts' );

    /* --------------------------------------------------------------
     *  Update
     * --------------------------------------------------------------
     */
    Route::get( 'edit/{contract}', [ ContractController::class, 'edit' ] )
         ->middleware( 'can:edit contract' )
         ->name( 'admin.contract.edit' );

    Route::put( 'edit/{contract}', [ ContractController::class, 'update' ] )
         ->middleware( 'can:edit contract' )
         ->name( 'admin.contract.update' );

    Route::delete( '/{contract}', [ ContractController::class, 'destroy' ] )
         ->middleware( 'can:delete contract' )
         ->name( 'admin.contract.delete' );
} );// Contracts

/* --------------------------------------------------------------
 *  Misc Deposits
 * --------------------------------------------------------------
 */
Route::prefix( 'deposits' )->group( function() {
    Route::get( '/', [ MiscDepositController::class, 'index' ] )
         ->name( 'admin.misc_deposits' )
         ->middleware( 'can:access misc deposits' );
    Route::post( '/', [ MiscDepositController::class, 'store' ] )
         ->name( 'admin.misc_deposits.create' )
         ->middleware( 'can:create misc deposits' );

    Route::patch( '/edit/{deposit}', [ MiscDepositController::class, 'edit' ] )
         ->name( 'admin.misc_deposits.edit' )
         ->middleware( 'can:edit misc deposits' );

    Route::put( '/edit/{deposit}', [ MiscDepositController::class, 'update' ] )
         ->name( 'admin.misc_deposits.update' )
         ->middleware( 'can:edit misc deposits' );

    Route::delete( '/{deposit}', [ MiscDepositController::class, 'destroy' ] )
         ->name( 'admin.misc_deposits.delete' )
         ->middleware( 'can:delete misc deposits' );
} );

/* --------------------------------------------------------------
 *  Daily Production Reports
 * --------------------------------------------------------------
 */
Route::prefix( 'daily-production-reports' )->group( function() {
     Route::get( '/', [ DailyProductionReportController::class, 'index' ] )
         ->name( 'admin.dpr' )
         ->middleware( 'can:access dpr' );
     Route::get( '/map', [ DailyProductionReportController::class, 'map' ] )
         ->name( 'admin.dpr.map' )
         ->middleware( 'can:access dpr' );  
     Route::post( '/get-reports-list', [ DailyProductionReportController::class, 'getReportsList' ] )
         ->name( 'admin.dpr.listing' )
         ->middleware( 'can:access dpr' );
     Route::post( '/approve', [ DailyProductionReportController::class, 'approve' ] )
          ->name( 'admin.dpr.approve' )
          ->middleware( 'can:approve dpr' );
} );

/* --------------------------------------------------------------
 *  Quality Assurance Survey
 * --------------------------------------------------------------
 */
Route::prefix( 'quality-assurance-survey' )->group( function() {
     Route::get( '/', [ QualityAssuranceSurveyController::class, 'index' ] )
         ->name( 'admin.qas' )
         ->middleware( 'can:access qas' );
     Route::get( '/sentricon', [ QualityAssuranceSurveyController::class, 'sentricon' ] )
         ->name( 'admin.qas.sentricon' )
         ->middleware( 'can:access qas' );
     Route::post( '/get-reports-list', [ QualityAssuranceSurveyController::class, 'getFieldAuditSurveyList' ] )
         ->name( 'admin.qas.listing' )
         ->middleware( 'can:access qas' );
     Route::get( '/survey-details/{id}', [ QualityAssuranceSurveyController::class, 'show' ] )
         ->name( 'admin.qas.detail' )
         ->middleware( 'can:access qas' );
     Route::get( '/survey-export/{id}', [ QualityAssuranceSurveyController::class, 'exportSurvey' ] )
         ->name( 'admin.qas.export' )
         ->middleware( 'can:access qas' );
     Route::get( '/sign/{id}', [ QualityAssuranceSurveyController::class, 'sign' ] )
         ->name( 'admin.qas.sign' )
         ->middleware( 'can:access qas' );
     Route::get( '/signed/{id}', [ QualityAssuranceSurveyController::class, 'signed' ] )
         ->name( 'admin.qas.signed' )
         ->middleware( 'can:add qas' );
     
     Route::get( '/download/{id}', [ DocuSignController::class, 'surveyDownload' ] )
         ->name( 'admin.qas.download' )
         ->middleware( 'can:access qas' );
     
} );


/* --------------------------------------------------------------
 *  Settings
 * --------------------------------------------------------------
 */
Route::prefix( 'settings' )->group( function() {
    Route::get( '/', [ SettingsController::class, 'index' ] )
         ->name( 'admin.settings' )
         ->middleware( 'can:manage settings' );

    Route::put( '/', [ SettingsController::class, 'update' ] )
         ->name( 'admin.settings' )
         ->middleware( 'can:manage settings' );
} );
