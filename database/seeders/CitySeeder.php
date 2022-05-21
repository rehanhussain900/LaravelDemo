<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use JsonException;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FileNotFoundException
     * @throws JsonException
     */
    public function run()
    {
        $data = Storage::disk( 'private' )->get( 'seeders/cities.json' );
        $cities = json_decode( $data, true, 512, JSON_THROW_ON_ERROR );
        foreach( $cities as $row ) {
            City::create( [
                'id'           => $row[ 'id' ],
                'name'         => $row[ 'name' ],
                'state_id'     => $row[ 'state_id' ],
                'state_code'   => $row[ 'state_code' ],
                'country_id'   => $row[ 'country_id' ],
                'country_code' => $row[ 'country_code' ],
                'latitude'     => $row[ 'latitude' ],
                'longitude'    => $row[ 'longitude' ],
            ] );
        }
    }
}
