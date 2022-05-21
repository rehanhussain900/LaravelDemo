<?php

namespace App\Models;

use App\Enums\ContractStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_name',
        'business_name',
        'service_address',
        'service_city',
        'service_state_id',
        'service_zip',
        'billing_name',
        'billing_address',
        'billing_city',
        'billing_state_id',
        'billing_zip',
        'phone_1',
        'phone_2',
        'attention_line',
        'email',
        'account_number',
        'proposed_by',
        'contract_date',
        'total_all_programs',
        'envelope_id',
        'status'
    ];

    /**
     * @return belongsTo
     */
    public function serviceState() : BelongsTo
    {
        return $this->belongsTo( State::class );
    }// serviceState

    /**
     * @return belongsTo
     */
    public function billingState() : BelongsTo
    {
        return $this->belongsTo( State::class );
    }// billingState

    /**
     * @return BelongsToMany
     */
    public function segments() : BelongsToMany
    {
        return $this->belongsToMany( Service::class );
    }// segments

    /**
     * @return hasMany
     */
    public function deletedContracts()
    {
        return $this->hasMany( DeletedContract::class  )->where('user_id' , Auth::id());
    }// deletedContracts

    /**
     * @return BelongsToMany
     */
    public function species() : BelongsToMany
    {
        return $this->belongsToMany( Specie::class )->using( ContractSpecie::class )
                    ->withPivot( [ 'total_program' ] );
    }// species

    /**
     * @return BelongsToMany
     */
    public function services() : BelongsToMany
    {
        return $this->belongsToMany( Service::class )
                    ->using( ContractService::class )
                    ->withPivot( [ 'specie_id', 'price', 'tax', 'discount', 'total', 'annual', 'notes' ] );
    }// services

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeSigned( $query )
    {
        return $query->whereStatus( ContractStatus::SIGNED );
    }// scopeSigned

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeUnsigned( $query )
    {
        return $query->where( 'status', '!=', ContractStatus::SIGNED );
    }

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
        static::creating( function( Contract $contract ) {
            $contract->user_id = Auth::id();
        } );
    }// boot


    /**
     * @param $query
     *
     * @return mixed
     */
    public function getCreatedAtAttribute()
    {
        return  date('d/m/Y', strtotime($this->attributes['created_at']));
    }

     /**
     * @param $query
     *
     * @return mixed
     */
    public function getAccountNumberAttribute()
    {
        return  $this->attributes['account_number']??'NA';
    }

}// Contract
