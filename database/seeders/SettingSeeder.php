<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            'app.name'  => 'HomeTeam',
            'app.email' => 'info@pestdefense.com',
        ];
        \option( $options );
    }
}
