<?php

namespace App\Http\Requests\DailyProductionReport;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DailyProductionReportListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can( 'access dpr' );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'tech_id'    => 'integer',
            'start_date' => 'string|date_format:Y-m-d|nullable',
            'end_date'   => 'string|date_format:Y-m-d|nullable'

        ];
    }
}
