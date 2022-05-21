<?php

namespace App\Repositories;

use App\Enums\ContractStatus;
use App\Models\Contract;
use App\Models\Service;
use App\Models\Specie;
use App\Models\DeletedContract;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class ContractRepository
{

    /**
     * @var Contract
     */
    private $contract;


    /**
     *
     */
    public function __construct( Contract $contract )
    {
        $this->contract = $contract;
    }// __construct

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function findByIDs( array $ids )
    {
        return $this->contract->find( $ids );
    }// findByIDs

    /**
     * @param $attributes
     *
     * @return Contract
     */
    public function create( $attributes )
    {
        $customer = $attributes[ 'customer_info' ];
        $contract_fields = [
            'customer_name'    => $customer[ 'name' ],
            'business_name'    => $customer[ 'business_name' ],
            'service_address'  => $customer[ 'service_address' ],
            'service_city'     => $customer[ 'service_city' ],
            'service_state_id' => $customer[ 'service_state_id' ]->id,
            'service_zip'      => $customer[ 'service_zip' ],
            'billing_name'     => $customer[ 'billing_name' ],
            'billing_address'  => $customer[ 'billing_address' ],
            'billing_city'     => $customer[ 'billing_city' ],
            'billing_state_id' => $customer[ 'billing_state_id' ]->id,
            'billing_zip'      => $customer[ 'billing_zip' ],
            'phone_1'          => $customer[ 'phone_1' ],
            'phone_2'          => $customer[ 'phone_2' ],
            'attention_line'   => $customer[ 'attention_line' ],
            'email'            => $customer[ 'email' ],
            'account_number'   => $customer[ 'account_number' ],
            'proposed_by'      => $customer[ 'proposed_by' ],
            'contract_date'    => $customer[ 'contract_date' ],
            'total_all_programs'              => $customer[ 'total_all_programs' ],
            'envelope_id'      => 0,
            'status'           => ContractStatus::PENDING,
        ];

        /**
         * @var Contract $contract
         */
        $contract = Contract::create( $contract_fields );
        //$contract->segments()->sync( $attributes[ 'segments' ] );

        $species = Specie::whereIn( 'slug', $attributes[ 'species' ] )->get();
        foreach( $species as $specie ) {
            $service_data = $attributes[ 'services' ][ $specie->slug ];
            $contract->species()->attach( $specie, [
                    'total_program' => $attributes[ 'services' ][ $specie->slug ][ 'fyp' ] ?? 0,
                ]
            );

            foreach( $service_data as $service_slug => $data ) {
                if( !is_array( $data ) ) {
                    continue;
                }
                if( empty( $data[ 'enabled' ] ) ) {
                    continue;
                }
                $service = Service::whereSlug( $service_slug )->first();
                $service_fields = [
                    'specie_id'  => $specie->id,
                    'service_id' => $service->id,
                    'price'      => $data[ 'price' ],
                    'tax'        => $data[ 'tax' ] ?? 0,
                    'discount'   => $data[ 'discount' ] ?? 0,
                    'total'      => $data[ 'total' ] ?? 0,
                    'annual'     => $data[ 'annual' ] ?? 0,
                    'notes'      => $data[ 'notes' ] ?? '',
                ];
                $contract->services()->attach( $service->id, $service_fields );
            }

        }// foreach

        return $contract;
    }// create


    /**
     * @param $attributes
     *
     * @return Contract
     */
    public function updateAll( $attributes )
    {
        $customer = $attributes[ 'customer_info' ];
        $contract_fields = [
            'customer_name'    => $customer[ 'name' ],
            'business_name'    => $customer[ 'business_name' ],
            'service_address'  => $customer[ 'service_address' ],
            'service_city'     => $customer[ 'service_city' ],
            'service_state_id' => $customer[ 'service_state_id' ]->id,
            'service_zip'      => $customer[ 'service_zip' ],
            'billing_name'     => $customer[ 'billing_name' ],
            'billing_address'  => $customer[ 'billing_address' ],
            'billing_city'     => $customer[ 'billing_city' ],
            'billing_state_id' => $customer[ 'billing_state_id' ]->id,
            'billing_zip'      => $customer[ 'billing_zip' ],
            'phone_1'          => $customer[ 'phone_1' ],
            'phone_2'          => $customer[ 'phone_2' ],
            'attention_line'   => $customer[ 'attention_line' ],
            'email'            => $customer[ 'email' ],
            'account_number'   => $customer[ 'account_number' ],
            'proposed_by'      => $customer[ 'proposed_by' ],
            'contract_date'    => $customer[ 'contract_date' ],
            'total_all_programs'              => $customer[ 'total_all_programs' ],
            'envelope_id'      => 0,
            'status'           => ContractStatus::PENDING,
        ];

        /**
         * @var Contract $contract
         */
        $contract = Contract::where('id', $customer['id'] )->update( $contract_fields );
        $contract = Contract::where('id', $customer['id'] )->first();
        //$contract->segments()->sync( $attributes[ 'segments' ] );

        $species = Specie::whereIn( 'slug', $attributes[ 'species' ] )->get();
        foreach( $species as $specie ) {
            $service_data = $attributes[ 'services' ][ $specie->slug ];
            $contract->species()->syncWithPivotValues( $specie, [
                    'total_program' => $attributes[ 'services' ][ $specie->slug ][ 'fyp' ] ?? 0,
                ]
            );

            foreach( $service_data as $service_slug => $data ) {
                if( !is_array( $data ) ) {
                    continue;
                }
                if( empty( $data[ 'enabled' ] ) ) {
                    continue;
                }
               
                $service = Service::whereSlug( $service_slug )->first();
                $service_fields = [
                    'specie_id'  => $specie->id,
                    'service_id' => $service->id,
                    'price'      => $data[ 'price' ],
                    'tax'        => $data[ 'tax' ] ?? 0,
                    'discount'   => $data[ 'discount' ] ?? 0,
                    'total'      => $data[ 'total' ] ?? 0,
                    'annual'     => $data[ 'annual' ] ?? 0,
                    'notes'      => $data[ 'notes' ] ?? '',
                ];
                $contract->services()->syncWithPivotValues( $service->id, $service_fields );
            }

        }// foreach

        return $contract;
    }// create

    public function update($contract_id, $data)
    {
        return Contract::where('id',$contract_id)->update( $data );
    }

    public function deleteContract( $contract_id )
    {
        $check = DeletedContract::where('contract_id', $contract_id)->where('user_id' , )->first();
        if(empty($check)){
            $obj = new DeletedContract();
            $obj->contract_id = $contract_id;
            $obj->user_id = Auth::user()->id;
            $obj->save();
            return true;
        }
        return false;
    }

}// ContractRepository
