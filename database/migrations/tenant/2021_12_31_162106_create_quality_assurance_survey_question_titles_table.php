<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityAssuranceSurveyQuestionTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_assurance_survey_question_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('status' , ['Active' , 'Inactive'])->default('Active');
            $table->enum('survey_type' , [ 'Field Audit', 'Sentricon Audit']);
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_assurance_survey_question_titles');
    }
}
