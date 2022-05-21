<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeleteContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_deletes', function (Blueprint $table) {
           
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('contract_id');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->cascadeOnDelete();
            $table->foreign( 'contract_id' )->references( 'id' )->on( 'contracts' )->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'deleted_contracts' );
    }
}
