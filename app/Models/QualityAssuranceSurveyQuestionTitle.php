<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualityAssuranceSurveyQuestionTitle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'status',
        'survey_type'
    ];

    /**
     * @return hasMany
     */
    public function questions()
    {
        return $this->hasMany( QualityAssuranceSurveyQuestion::class, 'title_id' );
    }// questions
}
