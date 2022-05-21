<?php

namespace App\Jobs;

use App\Repositories\PestPacBranchRepository;
use App\Services\PestPacService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use JsonException;

class SyncPestPacBranches implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pestPacService;
    private $branchesRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pestPacService = new PestPacService();
        $this->branchesRepository = new PestPacBranchRepository();
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws GuzzleException
     * @throws JsonException
     */
    public function handle()
    {
        $this->pestPacService->authenticate();
        $branches = $this->pestPacService->getBranches();
        $branches = json_decode( $branches, true, 512, JSON_THROW_ON_ERROR );
        foreach( $branches as $branch ) {
            $check = [ 'branch_id' => $branch[ 'BranchID' ] ];
            $update = [
                'name'         => $branch[ 'Name' ],
                'active'       => $branch[ 'Active' ],
                'sms_payments' => $branch[ 'EnableSMSPayments' ],
                'company_name' => $branch[ 'CompanyName' ],
            ];
            $this->branchesRepository->updateOrCreate( $check, $update );
        }
    }
}
