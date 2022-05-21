<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'countries', function( Blueprint $table ) {
            $table->id();
            $table->string( 'name' );
            $table->string( 'iso3', 4 )->nullable();
            $table->string( 'iso2', 3 )->nullable();
            $table->string( 'numeric_code' )->nullable();
            $table->string( 'phone_code' )->nullable();
            $table->string( 'capital' )->nullable();
            $table->string( 'currency' )->nullable();
            $table->string( 'currency_symbol' )->nullable();
            $table->string( 'tld', 12 )->nullable();
            $table->string( 'native' )->nullable();
            $table->string( 'region' )->nullable();
            $table->string( 'subregion' )->nullable();
            $table->string( 'zone_name' )->nullable();
            $table->string( 'gmt_offset' )->nullable();
            $table->string( 'gmt_offset_name' )->nullable();
            $table->string( 'tz_abbreviation' )->nullable();
            $table->string( 'tz_name' )->nullable();
            $table->string( 'latitude' )->nullable();
            $table->string( 'longitude' )->nullable();
            $table->string( 'emoji' )->nullable();
            $table->string( 'emojiU' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'countries' );
    }
}
