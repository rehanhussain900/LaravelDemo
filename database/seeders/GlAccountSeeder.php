<?php

namespace Database\Seeders;

use App\Models\GlAccountNumber;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 *
 */
class GlAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FileNotFoundException
     * @throws \JsonException
     */
    public function run()
    {
        $json_data = Storage::disk( 'global' )->get( 'private/seeders/gl-account-no.json' );
        $json_data = json_decode( $json_data, true, 512, JSON_THROW_ON_ERROR );

        foreach( $json_data as $row ) {
            GlAccountNumber::create( [
                'number' => $row[ 'GL Account Number' ],
                'label'  => $row[ 'GL Account Description' ]
            ] );
        }

    }// run

}// GlAccountSeeder
