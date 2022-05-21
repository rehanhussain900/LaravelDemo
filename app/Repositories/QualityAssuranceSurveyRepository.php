<?php

namespace App\Repositories;
use App\Models\QualityAssuranceSurvey;
use App\Models\QualityAssuranceSurveyAnswer;
use App\Models\QualityAssuranceSurveyQuestionTitle;

class QualityAssuranceSurveyRepository
{
    /**
     * @var QualityAssuranceSurvey
     */
    private $survey;


    /**
     *
     */
    public function __construct(QualityAssuranceSurvey $survey)
    {
        $this->survey = $survey;
    }

    public function save($data)
    {
    
       $survey = [
       'branch_id'              => $data['branch_id'],
       'customer_name'          => $data['customer_name'],
       'address'                => $data['address'],
       'account_number'         => $data['account_number'],
       'tech_id'                => $data['tech_id'],
       'audit_date'             => $data['audit_date'],
       'type'                   => $data['type'],
       'is_follow_up'           => $data['is_follow_up'],
       'name'                   => $data['name'],
       'title'                  => $data['title'],
       'auditor_id'             => $data['auditor_id'],
       'survey_date'            => $data['survey_date'],
       'is_pest_activity'       => $data['is_pest_activity'],
       'is_office_contact'      => $data['is_office_contact'],
       'pest_activity_areas'    => $data['pest_activity_areas'],
       'is_quality_inspection'  => $data['is_quality_inspection']
       ];
       

       if($survey['type'] == 'Field Audit'){
           
        $survey['treatement_date']      = $data['treatement_date'];
        $survey['service_duration']     = $data['service_duration'];
        $survey['pests_list']           = $data['pests_list'];

        }

       $this->survey = QualityAssuranceSurvey::create($survey);

       if($this->survey->id){
            foreach($data['answers'] as $arr){
                QualityAssuranceSurveyAnswer::create(array(
                    'question_id'   => $arr['question_id'],
                    'answer'        => $arr['answer'],
                    'comments'      => $arr['comments'],
                    'survey_id'     => $this->survey->id
                ));
            } 
         return $this->getDetail($this->survey->id);
       }
       else
       {
           return false;
       }
       
    }

    public function update($data, $id){

        $isUpdated = QualityAssuranceSurvey::where('id', $id)->update($data);
        if($isUpdated){
            return $this->getDetail($id);
        }
        return false; 

    }

    public function getDetail($id)
    {
       return QualityAssuranceSurvey::with([
            'branch' => function($q) {
                $q->select(['id', 'branch_id', 'name', 'sms_payments', 'company_name']);
            }, 
            'auditor' => function($q){
                $q->select(['id', 'name', 'email', 'azure_id', 'profile_photo_path']);
            }, 
            'technician' => function($q){
                $q->select(['id', 'name', 'email', 'azure_id', 'profile_photo_path']);
            },
            'questionTitle' => function($q){
                $q->select(['id', 'title', 'status', 'survey_type']);
            }, 
            'questionTitle.questions' => function($q){
                $q->select(['id', 'title', 'valid_answer', 'status', 'points', 'title_id']);
            }, 
            'questionTitle.questions.answer' => function($q) use($id) {
                $q->select(['id', 'answer as selected_ans', 'comments', 'question_id', 'survey_id']);
                $q->where('survey_id' , $id);
            } ])
            ->where('id', $id)->first();
    }

    public function getQuestions($type)
    {
        return QualityAssuranceSurveyQuestionTitle::with(['questions' => function($q){
            $q->select('id', 'title', 'points', 'title_id');
            $q->where('status' , 'Active');
        } ])->where('survey_type', $type)->get(['id', 'title', 'survey_type']);
    }
}
 