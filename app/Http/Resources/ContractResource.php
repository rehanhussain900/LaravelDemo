<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray( $request )
    {
        $res = [
            'customer_name'   => $this->customer_name,
            'service_address' => $this->service_address,
            'phone_home'      => $this->phone_home,
            'phone_cell'      => $this->phone_cell,
            'business_name'   => $this->business_name,
            'attention_line'  => $this->attention_line,
            'billing_address' => $this->billing_address,
            'email'           => $this->email,
            'status'          => $this->status,
            'envelope_id'     => $this->envelope_id,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];

        $species = [];

        foreach( $this->species as $row ) {
            $services = [];
            foreach( $this->services as $service ) {
                if( $service->specie_id === $row->id ) {
                    $services[] = $service;
                }
            }
            $row->services = $services;
            $species[] = $row;
        }
        $res[ 'species' ] = $species;

        return $res;
    }
}
