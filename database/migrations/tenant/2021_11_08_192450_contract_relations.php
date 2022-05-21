<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContractRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'contract_specie', function( Blueprint $table ) {
            $table->unsignedBigInteger( 'contract_id' );
            $table->unsignedBigInteger( 'specie_id' );
            $table->double( 'total_program', 10, 2 )->default( 0 );
            $table->unique( [ 'contract_id', 'specie_id' ] );
        } );

        Schema::create( 'contract_service', function( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'contract_id' )->nullable();
            $table->unsignedBigInteger( 'specie_id' )->nullable();
            $table->unsignedBigInteger( 'service_id' )->nullable();
            $table->double( 'price', 10, 2 );
            $table->double( 'tax', 10, 2 )->default( 0 );
            $table->double( 'discount', 10, 2 )->default( 0 );
            $table->double( 'total', 10, 2 )->default( 0 );
            $table->double( 'annual', 10, 2 )->default( 0 );
            $table->text( 'notes' );

            $table->foreign( 'contract_id' )->references( 'id' )->on( 'contracts' )->cascadeOnDelete();
            $table->foreign( 'service_id' )->references( 'id' )->on( 'services' )->cascadeOnDelete();
            $table->foreign( 'specie_id' )->references( 'id' )->on( 'species' )->cascadeOnDelete();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'contract_service' );
        Schema::dropIfExists( 'contract_specie' );
    }
}
