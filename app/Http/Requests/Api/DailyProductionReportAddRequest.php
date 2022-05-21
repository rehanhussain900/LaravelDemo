<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DailyProductionReportAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can( 'create dpr' );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_number'    => 'required|integer',
                'customer_name'  => 'required|string',
                'address'        => 'required|string',
                'service_code'   => 'required|string',
                'value'          => 'required|numeric',
                'time_in'        => 'required',
                'time_out'       => 'required',
                'service_time'   => 'required',
                'confirmed'      => 'required|boolean',
                // 'status'         => 'required|',
                // 'tech_id'        => 'required'
            ];
    }
}
