<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePestPacBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'pest_pac_branches', function( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'branch_id' );
            $table->string( 'name' );
            $table->boolean( 'active' );
            $table->boolean( 'sms_payments' );
            $table->string( 'company_name' );
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
        Schema::dropIfExists( 'pest_pac_branches' );
    }
}
