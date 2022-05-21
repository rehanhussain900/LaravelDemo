<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'cities', function( Blueprint $table ) {
            $table->id();
            $table->string( 'name' );
            $table->unsignedBigInteger( 'state_id' );
            $table->string( 'state_code' );
            $table->unsignedBigInteger( 'country_id' );
            $table->string( 'country_code' );
            $table->string( 'latitude' );
            $table->string( 'longitude' );
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
        Schema::dropIfExists( 'cities' );
    }
}
