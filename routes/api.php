<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DailyProductionReportAPIController;
use App\Http\Controllers\Api\BranchAPIController;
use App\Http\Controllers\Api\QualityAssuranceSurveyAPIController;
use App\Http\Controllers\Api\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* --------------------------------------------------------------
 *  Auth Routes
 * --------------------------------------------------------------
 */
Route::post( 'login', [ AuthController::class, 'login' ] );

Route::post( 'forget-password', [ AuthController::class, 'forgetPassword' ] );


Route::middleware(['auth:sanctum' ])->group( function() {

    Route::get( '/user', function( Request $request ) {
        return $request->user();
    } );

    /* --------------------------------------------------------------
    *  Daily Production Reports
    * --------------------------------------------------------------
    */
    Route::prefix( 'daily-prodcution-report' )->group( function() {

        Route::post('/', [DailyProductionReportAPIController::class, 'store'])->middleware( 'can:create dpr' );
        Route::get('/tech-reports', [DailyProductionReportAPIController::class, 'technicianReports'])->middleware( 'can:access dpr' );
    
    } );

    /* --------------------------------------------------------------
    *  Quality Assurance Survey
    * --------------------------------------------------------------
    */
    Route::prefix( 'quality-assurance-survey' )->group( function() {

        Route::post('/store', [QualityAssuranceSurveyAPIController::class, 'store'])->middleware( 'can:create qas' );
        Route::get('/get-survey-question/{type}', [QualityAssuranceSurveyAPIController::class, 'getSurveyQuestions'])->middleware( 'can:create qas' );
        Route::get('/get-survey/{id}', [QualityAssuranceSurveyAPIController::class, 'show'])->middleware( 'can:access qas' );
    
    } );

    /* --------------------------------------------------------------
    *  Branches
    * --------------------------------------------------------------
    */
    Route::prefix( 'branches' )->group( function() {

        Route::post('/', [BranchAPIController::class, 'index']);
    
    } );

    /* --------------------------------------------------------------
    *  Listing APIs for modules support 
    * --------------------------------------------------------------
    */
    Route::prefix( 'users' )->group( function() {

        Route::get('/technicians', [UserAPIController::class, 'getTechnicians']);
    
    } );
    
} );
