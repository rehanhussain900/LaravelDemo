<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityAssuranceSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_assurance_surveys', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('branch_id');
            $table->string('customer_name');
            $table->string('address');
            $table->string('account_number');
            $table->unsignedBigInteger('tech_id');
            $table->date('treatdment_date');
            $table->unsignedBigInteger('auditor_id');
            $table->date('audit_date');
            $table->enum('type', [ 'Field Audit', 'Sentricon Audit']);
            $table->string('auditor_signature')->nullable();
            $table->string('technician_signature')->nullable();
            $table->double('interview_score', 8, 2)->nullable();
            $table->double('inspection_score', 8, 2)->nullable();
            $table->double('average_score', 8, 2)->nullable();
            $table->boolean('is_follow_up')->default(0);
            $table->boolean('is_pest_activity')->default(0);
            $table->string('pests_list')->nullable();
            $table->boolean('is_office_contact')->default(0);
            $table->string('pest_activity_areas')->nullable();
            $table->boolean('is_quality_inspection')->default(0);
            $table->string('name');
            $table->string('title');
            $table->date('survey_date');
            $table->double('point_total', 8, 2)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign( 'tech_id' )->references( 'id' )->on( 'users' )->cascadeOnDelete();
            $table->foreign( 'auditor_id' )->references( 'id' )->on( 'users' )->cascadeOnDelete();
            $table->foreign( 'branch_id' )->references( 'id' )->on( 'pest_pac_branches' )->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_assurance_surveys');
    }
}
