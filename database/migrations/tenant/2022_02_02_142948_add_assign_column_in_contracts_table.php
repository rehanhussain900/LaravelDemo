<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignColumnInContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->date('service_date')->after('total_all_programs')->nullable(); 
            $table->string('service_time')->after('total_all_programs')->nullable(); 
            $table->foreignId('tech_id')->after('total_all_programs')->nullable(); 
            $table->string('estimated_work_hours')->after('total_all_programs')->nullable(); 

            $table->foreign( 'tech_id' )->references( 'id' )->on( 'users' )->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            //
        });
    }
}
