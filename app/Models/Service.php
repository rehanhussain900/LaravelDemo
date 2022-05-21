<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 *
 */
class Service extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'description', 'sort_order', 'parent_id'
    ];

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo( self::class, 'parent_id' );
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany( self::class, 'parent_id' );
    }

    /**
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom( 'name' )
                          ->saveSlugsTo( 'slug' );
    }// getSlugOptions

}// ContractService
