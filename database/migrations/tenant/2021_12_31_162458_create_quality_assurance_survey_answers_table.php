<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityAssuranceSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_assurance_survey_answers', function (Blueprint $table) {
            $table->id();
            $table->enum('answer', ['Yes' , 'No', 'NA'])->default('NA');
            $table->string('comments')->nullable();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('survey_id');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign( 'question_id' )->references( 'id' )->on( 'quality_assurance_survey_questions' )->cascadeOnDelete();
            $table->foreign( 'survey_id' )->references( 'id' )->on( 'quality_assurance_surveys' )->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_assurance_survey_answers');
    }
}
