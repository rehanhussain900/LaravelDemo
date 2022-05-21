<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate( $checkAttribute, $updateAttribute )
 */
class PestPacBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id', 'name', 'active', 'sms_payments', 'company_name'
    ];
}// PestPacBranch
