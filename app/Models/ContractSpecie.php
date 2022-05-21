<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ContractSpecie extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'specie_id',
        'total_program',
        'total_all',
    ];
}
