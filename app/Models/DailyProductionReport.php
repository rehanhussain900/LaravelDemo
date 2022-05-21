<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyProductionReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_number',
        'customer_name',
        'address',
        'service_code',
        'value',
        'time_in',
        'time_out',
        'service_time',
        'confirmed',
        'status',
        'tech_id'
    ];

    public function user()
    {
        return $this->belongsTo( User::class );
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function getCreatedAtAttribute()
    {
        return  date('F j, Y', strtotime($this->attributes['created_at']));
    }
}
