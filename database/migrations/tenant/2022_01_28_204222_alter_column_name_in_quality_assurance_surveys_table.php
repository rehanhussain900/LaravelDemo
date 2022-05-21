<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnNameInQualityAssuranceSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quality_assurance_surveys', function (Blueprint $table) {
            $table->renameColumn('treatdment_date', 'treatement_date');
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
            $table->renameColumn('treatement_date', 'treatdment_date');
        });
    }
}
