<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DailyProductionReportAddRequest;
use Illuminate\Http\JsonResponse;
use App\Services\DailyProductionReportService;

class DailyProductionReportAPIController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
    
     * @return \Illuminate\Http\Response
     */
    public function store(DailyProductionReportAddRequest $request)
    {
        $data = $request->validated();
        $report = $this->reportService->saveReport($data);
        if($report->id){
            return new JsonResponse( [ 'message' => 'Report Added', 'status' => 1, 'data' => ''  ], 200 );
        }
        return new JsonResponse( [ 'message' => 'Something went wrong' , 'status' => 0, 'data' => '' ], 200 );
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource for technicain ID .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function technicianReports()
    {
        try{
            $reports = $this->reportService->getTechnicianReports();
            return new JsonResponse( [ 'message' => '', 'status' => 1, 'data' => $reports  ], 200 );
        }
        catch(\Exception $e){
            return new JsonResponse( [ 'message' => $e->getMessage() , 'status' => 0, 'data' => '' ], 200 );
        }
    }
}
