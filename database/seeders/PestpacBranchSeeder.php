<?php

namespace Database\Seeders;

use App\Jobs\SyncPestPacBranches;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;
use JsonException;

class PestpacBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws GuzzleException
     * @throws JsonException
     */
    public function run()
    {
        ( new SyncPestPacBranches() )->handle();
    }
}
