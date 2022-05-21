<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityAssuranceSurveyQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_assurance_survey_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('points');
            $table->enum('status' , ['Active' , 'Inactive'])->default('Active');
            $table->unsignedBigInteger('title_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign( 'title_id' )->references( 'id' )->on( 'quality_assurance_survey_question_titles' )->cascadeOnDelete();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_assurance_survey_questions');
    }
}
