<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualityAssuranceSurveyAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'answer',
        'comments',
        'question_id',
        'survey_id'
    ];

    /**
     * @return belongToOne
     */
    public function survey()
    {
        return $this->belongToOne( QualityAssuranceSurveyAnswer::class, 'survey_id' );
    }// survey

    /**
     * @return belongToOne
     */
    public function questions()
    {
        return $this->belongToOne( QualityAssuranceSurveyQuestion::class, 'question_id' );
    }// question
}
