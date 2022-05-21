<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 *
 */
class Role extends Model
{
    use HasFactory, HasSlug, LogsActivity;

    protected $fillable = [
        'label',
        'name',
        'permissions'
    ];

    protected static $logAttributes = [ '*' ];

    protected $casts = [
        'permissions' => 'json',
    ];

    /**
     * @return BelongsToMany
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany( User::class );
    }// users

    /**
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute( $date )
    {
        return Carbon::make( $date )->format( 'm/d/Y' );
    }// getCreatedAtAttribute

    /**
     * @param $date
     *
     * @return string
     */
    public function getUpdatedAtAttribute( $date )
    {
        return Carbon::make( $date )->format( 'm/d/Y' );
    }// getUpdatedAtAttribute

    /**
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom( 'label' )
                          ->saveSlugsTo( 'name' );
    }// getSlugOptions

}// Role
