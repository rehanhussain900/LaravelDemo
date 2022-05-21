<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityAssuranceSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
                            "branch_id",
                            "customer_name",
                            "address",
                            "account_number",
                            "tech_id",
                            "treatement_date",
                            "auditor_id",
                            "audit_date",
                            "type",
                            "service_duration",
                            "auditor_signature",
                            "auditor_envelope_id",
                            "auditor_signature_status",
                            "technician_signature",
                            "technician_signature_status",
                            "technician_envelope_id",
                            "interview_score",
                            "inspection_score",
                            "is_follow_up",
                            "is_pest_activity",
                            "pests_list",
                            "is_office_contact",
                            "pest_activity_areas",
                            "is_quality_inspection",
                            "name",
                            "title",
                            "survey_date",
                            "point_total",
                        ];
    
    public function technician()
    {
        return $this->belongsTo( User::class , 'tech_id' );
    }

    public function auditor()
    {
        return $this->belongsTo( User::class , 'auditor_id' );
    }

    public function branch()
    {
        return $this->belongsTo( PestPacBranch::class , 'branch_id' );
    }

    public function questionTitle()
    {
        return $this->hasMany( QualityAssuranceSurveyQuestionTitle::class , 'survey_type' ,'type' );
    }

    /**
     * @return hasMany
     */
    public function submissions()
    {
        return $this->hasMany( QualityAssuranceSurveyAnswer::class, 'survey_id' );
    }// submissions

    /**
     * @return String
     */
    function getAverageScoreAttribute($value){
        return self::where('type',$this->attributes['type'])->avg('point_total');
    }
}
