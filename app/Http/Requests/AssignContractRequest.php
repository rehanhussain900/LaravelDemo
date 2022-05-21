<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AssignContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can( 'assign contract' );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'service_date'              => 'required|date_format:Y-m-d',
            'service_time'              => 'required|string',
            'tech_id'                   => 'required|string',
            'estimated_work_hours'      => 'required|string',
            
        ];
    }
}
