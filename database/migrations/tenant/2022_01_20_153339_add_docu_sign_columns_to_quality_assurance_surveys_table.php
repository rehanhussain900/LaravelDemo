<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocuSignColumnsToQualityAssuranceSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quality_assurance_surveys', function (Blueprint $table) {
            $table->string('envelope_id')->after('auditor_signature')->nullable(); 
            $table->string('auditor_signature_status')->after('auditor_signature')->nullable(); 
            $table->string('technician_signature_status')->after('technician_signature')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quality_assurance_surveys', function (Blueprint $table) {
            //
        });
    }
}
