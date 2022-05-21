<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QualityAssuranceSurveyQuestionTitle;

class QualityAssuranceSurveyQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [
                'title'         =>'Customer Interview Questions (Yes/No/NA)',
                'status'        =>'Active',
                'survey_type'   =>'Field Audit'
            ],
            [
                'title'         =>'Exterior Inspection (Yes/No/NA)',
                'status'        =>'Active',
                'survey_type'   =>'Field Audit'
            ],
            [
                'title'         =>'Sentricon (Yes/No/NA with comment box)',
                'status'        =>'Active',
                'survey_type'   =>'Sentricon Audit'
            ]
        ];
        foreach( $data as $obj ){
            QualityAssuranceSurveyQuestionTitle::create( $obj );
        }
    }
}
