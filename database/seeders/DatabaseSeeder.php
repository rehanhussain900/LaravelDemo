<?php

namespace Database\Seeders;

use App\Models\Specie;
use App\Models\PestPacBranch;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() : void
    {
        $this->call( RoleSeeder::class );
        $this->call( UserSeeder::class );
        $this->call( SpecieSeeder::class );
        $this->call( ServiceSeeder::class );
        $this->call( GlAccountSeeder::class );
        $this->call( PestpacBranchSeeder::class );
        $this->call( SettingSeeder::class );
        $this->call( CountrySeeder::class );
        $this->call( CitySeeder::class );
        $this->call( StateSeeder::class );
    }
}
