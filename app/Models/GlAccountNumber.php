<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class GlAccountNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'label'
    ];

}// GlAccountNumber
