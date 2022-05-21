<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
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
        $data = Storage::disk( 'private' )->get( 'seeders/countries.json' );
        $countries = json_decode( $data, true, 512, JSON_THROW_ON_ERROR );
        foreach( $countries as $row ) {
            Country::create( [
                'id'              => $row[ 'id' ],
                'name'            => $row[ 'name' ],
                'iso3'            => $row[ 'iso3' ],
                'iso2'            => $row[ 'iso2' ],
                'numeric_code'    => $row[ 'numeric_code' ],
                'phone_code'      => $row[ 'phone_code' ],
                'capital'         => $row[ 'capital' ],
                'currency'        => $row[ 'currency' ],
                'currency_symbol' => $row[ 'currency_symbol' ],
                'tld'             => $row[ 'tld' ],
                'native'          => $row[ 'native' ],
                'region'          => $row[ 'region' ],
                'subregion'       => $row[ 'subregion' ],
                'zone_name'       => $row[ 'timezones' ][ 0 ][ 'zoneName' ] ?? '',
                'gmt_offset'      => $row[ 'timezones' ][ 0 ][ 'gmtOffset' ],
                'gmt_offset_name' => $row[ 'timezones' ][ 0 ][ 'gmtOffsetName' ],
                'tz_abbreviation' => $row[ 'timezones' ][ 0 ][ 'abbreviation' ],
                'tz_name'         => $row[ 'timezones' ][ 0 ][ 'tzName' ],
                'latitude'        => $row[ 'latitude' ],
                'longitude'       => $row[ 'longitude' ],
                'emoji'           => $row[ 'emoji' ],
                'emojiU'          => $row[ 'emojiU' ],
            ] );
        }
    }// run
}
