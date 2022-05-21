<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'iso3', 'iso2', 'numeric_code',
        'phone_code', 'capital', 'currency', 'currency_symbol',
        'tld', 'native', 'region', 'subregion', 'zone_name',
        'gmt_offset', 'gmt_offset_name', 'tz_abbreviation',
        'tz_name', 'latitude', 'longitude', 'emoji', 'emojiU',
    ];

}// Country
