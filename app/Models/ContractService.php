<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 *
 */
class ContractService extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'specie_id',
        'service_id',
        'price',
        'tax',
        'discount',
        'total',
        'annual',
        'notes',
    ];
}
