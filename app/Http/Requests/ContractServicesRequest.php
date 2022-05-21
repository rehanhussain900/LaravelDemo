<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class ContractServicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can( 'add contract' );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'species' => 'required',
            'total_all_programs'     => 'required'
        ];
    }

    /**
     * @param $validator
     */
    public function withValidator( $validator ) : void
    {
        $validator->after( function( $validator ) {
            $species = $this->input( 'species', [] );
            foreach( $species as $specie ) {
                $enabled_any = false;
                $specie_data = $this->input( $specie, [] );
                if( empty( $specie_data[ 'fyp' ] ) ) {
                    $validator->errors()->add( $specie . '[fyp]',
                        'Total First Year for this Program is required' );
                }
                foreach( $specie_data as $key => $data ) {
                    if( !empty( $data[ 'enabled' ] ) && empty( $data[ 'price' ] ) ) {
                        $validator->errors()->add( $specie . '[' . $key . '][price]',
                            'Please Enter price for the Selected Service' );
                    }
                    if( !empty( $data[ 'enabled' ] ) ) {
                        $enabled_any = true;
                    }
                }
                if( !$enabled_any ) {
                    $validator->errors()->add( $specie, 'Select at least One Service' );
                }
            }
        } );
    }// withValidator

    public function messages()
    {
        return [
            'total_all_programs.required' => 'Total First Year for All Program field is required'
        ];
    }

}
