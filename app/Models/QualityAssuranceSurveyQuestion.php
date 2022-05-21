<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualityAssuranceSurveyQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'valid_answer',
        'points',
        'status',
        'title_id'
    ];

    /**
     * @return belongsTo
     */
    public function user(): belongsTo
    {
        return $this->belongsTo( QualityAssuranceSurveyQuestionTitle::class, 'title_id' );
    }

    /**
     * @return hasOne
     */
    public function answer()
    {
        return $this->hasOne( QualityAssuranceSurveyAnswer::class, 'question_id' );
    }
}
