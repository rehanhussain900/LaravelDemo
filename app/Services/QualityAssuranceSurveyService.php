<?php

namespace App\Services;
use App\Repositories\QualityAssuranceSurveyRepository;
use App\Models\QualityAssuranceSurvey;
use App\Models\QualityAssuranceSurveyQuestionTitle;
use Illuminate\Support\Facades\Auth;

class QualityAssuranceSurveyService
{
    private $surveryRepository;

    public function __construct(QualityAssuranceSurveyRepository $repository)
    {
        $this->surveryRepository = $repository;
    }

    public function saveSurvey($data)
    {
       $data['auditor_id'] = Auth::id();
       $suvery = $this->surveryRepository->save($data);
        if($suvery->id){
            $interview_score = 0;
            $inspection_score = 0;
            foreach($suvery->questionTitle as $title)
            {
                foreach ($title->questions as $question)
                {
                    $valid_ans = in_array($question->answer->selected_ans, explode(',',$question->valid_answer)) ? $question->answer->selected_ans : '' ; 
                    if(!empty($valid_ans)){
                        if($title->title == 'Customer Interview Questions (Yes/No/NA)'){
                            $interview_score += $question->points; 
                        }
                        elseif($title->title == 'Exterior Inspection (Yes/No/NA)'){
                            $inspection_score += $question->points; 
                        }
                        //for sentricon audit
                        elseif($title->title == 'Sentricon (Yes/No/NA with comment box)'){
                            $interview_score += $question->points; 
                        }
                    }
                    
                }
            }

            $updatedData['interview_score'] = $interview_score ;
            $updatedData['inspection_score'] = $inspection_score ;
            $updatedData['point_total'] = $interview_score + $inspection_score ;

            $updatedSuvery = $this->surveryRepository->update($updatedData, $suvery->id);

            return $updatedSuvery;
        }
        return false;
       
    }

    public function getSurvey($id)
    {
       return $this->surveryRepository->getDetail($id);
    }
    public function getSurveyQuestion($type)
    {
        return $this->surveryRepository->getQuestions($type);
    }

    public function updateSurvey($data, $id)
    {
       return  $this->surveryRepository->update($data, $id);
    }

    public function preparePDF($survey)
    {
        $path = public_path('surveys');
        $filename ='survey_'.$survey->id.'.pdf';
        $full_path = $path . '/' . $filename;
        if (file_exists( $full_path )) {
             return $full_path;
        }   
        $pdf = $survey->type=='Sentricon Audit' ? \PDF::loadView( 'admin.quality-assurance-surveys.sentricon-audit.pdf_preview', compact( 'survey' ) ) : \PDF::loadView( 'admin.quality-assurance-surveys.field-audit.pdf_preview', compact( 'survey' ) );
        
        $pdf->save( $full_path );
        return $full_path;
    }
}
