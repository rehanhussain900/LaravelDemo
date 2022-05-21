<?php

namespace App\Services;

use App\Enums\HttpStatus;
use App\Models\Service;
use App\Models\Specie;
use App\Models\State;
use App\Repositories\ContractRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use Illuminate\Support\Facades\File; 

/**
 *
 */
class ContractService
{
    private $repository;

    /**
     *
     */
    public function __construct( ContractRepository $contractRepository )
    {
        $this->repository = $contractRepository;
    }// __construct

    /**
     * @param $customer_info
     *
     * @return $this
     */
    public function setCustomerInfo( $customer_info ) : ContractService
    {
        $input = $this->getSessionData();
        $input[ 'customer_info' ] = $customer_info;
        $input[ 'customer_info' ][ 'billing_state_id' ] = State::find( $input[ 'customer_info' ][ 'billing_state_id' ] );
        $input[ 'customer_info' ][ 'service_state_id' ] = State::find( $input[ 'customer_info' ][ 'service_state_id' ] );
        $this->setSessionData( $input );
        return $this;
    }// setCustomerInfo

    /**
     * @param $customer_info
     *
     * @return $this
     */
    public function setCustomerInfoFromContract( $customer_info ) 
    {

        $customer_info = $customer_info;
        $customer_info[ 'billing_state_id' ] = State::find( $customer_info[ 'billing_state_id' ] );
        $customer_info[ 'service_state_id' ] = State::find( $customer_info[ 'service_state_id' ] );
        
        return $customer_info;
    }// setCustomerInfoFromContract

     /**
     * @param $contract_id, $data
     *
     * @return $this
     */
    public function updateContract( $contract_id, $data ) 
    {
       return $this->repository->update($contract_id, $data);
        
    }// updateContract

    /**
     * @param $species
     *
     * @return $this
     */
    public function setSpecies( $species ) : ContractService
    {
        $input = $this->getSessionData();
        $input[ 'species' ] = $species;
        $input[ 'customer_info' ][ 'total_all_programs' ] = request( 'total_all_programs' );
        $this->setSessionData( $input );
        return $this;
    }

    public function setServices( $services ) : ContractService
    {
        $input = $this->getSessionData();
        $input[ 'services' ] = $services;
        $this->setSessionData( $input );
        return $this;
    }


    /**
     * @return mixed
     */
    public function getSessionData()
    {
        return Session::get( '_contract_input',
            [ 'services' => [], 'species' => [], 'customer_info' => [] ] );
    }

    /**
     *
     */
    public function getDecoratedSessionData()
    {
        $data = $this->getSessionData();
        /*$species = [];
        if( !empty( $data[ 'species' ] ) ) {
            foreach( $data[ 'species' ] as $specie ) {
                $species[] = Specie::whereSlug( $specie )->first();
            }
        }*/
        $services = [];
        if( !empty( $data[ 'services' ] ) ) {
            foreach( $data[ 'services' ] as $key => $val ) {
                $specie = Specie::whereSlug( $key )->first()->toArray();
                $specie[ 'fyp' ] = $val[ 'fyp' ];
                $specie[ 'services' ] = [];
                foreach( $val as $sk => $sv ) {
                    if( in_array( $sk, [ 'fyp', 'fya' ] ) ) {
                        continue;
                    }
                    $sv[ 'service' ] = Service::with( 'parent' )->whereSlug( $sk )->first();
                    $specie[ 'services' ][] = $sv;
                }
                $services[] = $specie;
            }
        }

        return [ 'customer_info' => $data[ 'customer_info' ], 'services' => $services ];
    }// getDecoratedSessionData

    /**
     * @param $data
     *
     * @return ContractService
     */
    private function setSessionData( $data ) : ContractService
    {
        Session::put( '_contract_input', $data );
        return $this;
    }

    /**
     *
     */
    public function destroySessionData()
    {
        Session::forget( '_contract_input' );
    }

    /**
     * Create Contract data in Database
     */
    public function make()
    {
        $session = $this->getSessionData();
        $this->validate( $session );
        if( array_key_exists('id' , $session['customer_info'])){
            $contract = $this->repository->updateAll( $session );
        } 
        else
        {
            $contract = $this->repository->create( $session );
        }
        
        $this->preparePdf( $contract->id );
        $this->destroySessionData();
        return $contract;
    }// make

    /**
     * @param $session
     */
    public function validate( $session ) : void
    {
        if( empty( $session[ 'customer_info' ] ) ) {
            abort( HttpStatus::BadRequest, 'Customer Information Required' );
        }
        if( empty( $session[ 'species' ] ) ) {
            abort( HttpStatus::BadRequest, 'Species Required' );
        }
        if( empty( $session[ 'services' ] ) ) {
            abort( HttpStatus::BadRequest, 'Services Required' );
        }
    }// validate

    /**
     * @param $id
     */
    public function preparePdf( $id )
    {
        $session = $this->getDecoratedSessionData();
        /*print_r( $session );
        exit;*/
        $pdf = \PDF::loadView( 'admin.templates.contracts.default', $session );
        if(file_exists( 'contracts/contract-' . $id . '.pdf' )){
            File::delete( 'contracts/contract-' . $id . '.pdf');
        }
        $pdf->save( 'contracts/contract-' . $id . '.pdf' );
    }

    /**
     * @return mixed
     */
    public function deleteContractForUser($contract_id)
    {
        return $this->repository->deleteContract($contract_id);
    }

}// ContractService
