<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Theme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mpdf\MpdfException;
use App\Models\User;
use App\Http\Requests\DailyProductionReport\DailyProductionReportApproveRequest;
use App\Http\Requests\DailyProductionReport\DailyProductionReportListingRequest;
use App\Models\DailyProductionReport;
use App\Enums\DailyProductionReportStatus;
use Illuminate\Http\JsonResponse;
use App\Services\DailyProductionReportService;

/**
 *
 */
class DailyProductionReportController extends Controller
{
    /**
     * @var DailyProductionReportService
     */
    private $reportService;

    /**
     * @param DailyProductionReportService $surveyService
     */
    public function __construct(
        DailyProductionReportService $reportService
    ) {
        $this->reportService = $reportService;
    }// __construct
    /**
     *
     */
    public function index( Request $request )
    {
        $technicians = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Technician');
            }
        )->get();
        return Theme::view( 'daily-production-reports.index', compact('technicians'));
    }// index

    /**
     * @param DailyProductionReportApproveRequest $request
     *
     * @return JsonResponse
     */
    public function approve(DailyProductionReportApproveRequest $request)
    {
        $check = DailyProductionReport::where('id' , $request->id)->update(['status' => DailyProductionReportStatus::APPROVED ]);
        if($check){
            return new JsonResponse( [ 'message' => 'Report Approved Successfully.' , 'status' => 1, 'data' => '' ], 200 );
        }
        return new JsonResponse( [ 'message' => 'Something went wrong' , 'status' => 0, 'data' => '' ], 200 );

    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getReportsList(DailyProductionReportListingRequest $request)
    {

        try{


            $technicians = $this->reportService->getReportsList($request);

            if( $request->export == 1 ) {
                $filename = $this->reportService->preparePdf($technicians);
                return new JsonResponse( [ 'message' => 'Report Exported Successfully.' , 'status' => 1, 'data' => $filename ], 200 );
            }
            return new JsonResponse( [ 'message' => 'Report Generated Successfully.' , 'status' => 1, 'data' => (string)Theme::view( 'daily-production-reports.overview', compact('technicians')) ], 200 );
        }
        catch (\Exception $e){
            return new JsonResponse( [ 'message' =>  $e->getMessage() , 'status' => 0, 'data' => '' ], 200 );
        }
        
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function exportReportsList(Request $request)
    {
        if( $request->has( 'export' ) ) {
            $expand = 1;
            $pdf = \PDF::loadView( 'admin.daily-production-reports.export-pdf', compact( 'technicians', 'expand' ) );
            return $pdf->stream( 'daily_production_reports.pdf' );
        }
    }

}// DailyProductionReportController
