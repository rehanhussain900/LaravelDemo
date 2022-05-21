<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTreatementDateAndServiceDurationNullableInTableQualityAssuranceSurveys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quality_assurance_surveys', function (Blueprint $table) {
            $table->date('treatdment_date')->nullable()->change();
            $table->string('service_duration')->nullable()->change();
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
