<?php

namespace App\Services;
use App\Repositories\DailyProductionReportRepository;
use App\Enums\DailyProductionReportStatus;
use Illuminate\Support\Facades\Auth;

class DailyProductionReportService
{
    private $reportRepository;

    public function __construct(DailyProductionReportRepository $repository)
    {
        $this->reportRepository = $repository;
    }

    public function saveReport($data)
    {
        $data['status'] = DailyProductionReportStatus::SUBMITTED;
        $data['tech_id'] = Auth::id();
        return $this->reportRepository->save($data);
    }

    public function getTechnicianReports()
    {
        $id = Auth::id();
        return $this->reportRepository->getTechnicianReports($id);      
    }

    public function getReportsList($request)
    {
       
        return $this->reportRepository->getReports($request); 
            
    }

    public function preparePdf($technicians)
    {
        $expand = 1;
        $pdf = \PDF::loadView( 'admin.daily-production-reports.export-pdf', compact( 'technicians', 'expand' ) );
        $path = public_path('/reports');
        $filename ='daily_production_reports_'.time().'.pdf';
        $pdf->save( $path . '/' . $filename);
        return $filename;
    }

}
