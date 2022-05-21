<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 *
 */
class StateSeeder extends Seeder
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
        $data = Storage::disk( 'private' )->get( 'seeders/states.json' );
        $states = json_decode( $data, true, 512, JSON_THROW_ON_ERROR );
        foreach( $states as $row ) {
            State::create( [
                'id'           => $row[ 'id' ],
                'name'         => $row[ 'name' ],
                'country_id'   => $row[ 'country_id' ],
                'country_code' => $row[ 'country_code' ],
                'state_code'   => $row[ 'state_code' ],
                'latitude'     => $row[ 'latitude' ],
                'longitude'    => $row[ 'longitude' ],
            ] );
        }

    }// run

}// StateSeeder
