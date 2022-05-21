<?php

namespace App\Repositories;
use App\Models\DailyProductionReport;
use App\Models\User;

class DailyProductionReportRepository
{
    /**
     * @var DailyProductionReport
     */
    private $report;


    /**
     *
     */
    public function __construct(DailyProductionReport $report)
    {
        $this->report = $report;
    }

    public function save( $data )
    {
        return DailyProductionReport::create( $data );
    }

    public function getTechnicianReports($id)
    {
        return DailyProductionReport::where('tech_id' , $id)->get();
    }

    public function getReports($request)
    {
        $technicians = User::with(['DailyProductionReports' =>  
                function ($query) use($request) {
                    if(!empty($request->start_date))
                        $query = $query->where('created_at', '>=', $request->start_date.' 00:00:00');
                    if(!empty($request->end_date))
                        $query = $query->where('created_at', '<=', $request->end_date.' 23:59:59');
                    
                    return $query->where('status' , $request->status)->orderBy('created_at' , 'DESC');
                }])
                ->whereHas(
                'roles', function($q){
                    $q->where('name', 'Technician');
                }
        );

        if($request->tech_id > 0){
            $technicians = $technicians->where('id' , $request->tech_id);
        }
        return $technicians = $technicians->get();   
    }
}
