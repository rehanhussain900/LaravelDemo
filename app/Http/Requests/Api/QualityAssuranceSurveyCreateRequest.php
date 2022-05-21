<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\RequiredPestActivityField;
use Illuminate\Http\Request;

class QualityAssuranceSurveyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can( 'create qas' );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'branch_id'             => 'required|string',
                'customer_name'         => 'required|string',
                'address'               => 'required|string',
                'account_number'        => 'required|alpha_num',
                'tech_id'               => 'required|integer',
                'treatement_date'       => 'required_if:type,Field Audit|date_format:Y-m-d',
                'audit_date'            => 'required|date_format:Y-m-d',
                'type'                  => 'required|in:Field Audit,Sentricon Audit',
                'service_duration'      => 'required_if:type,Field Audit|string',
                'is_follow_up'          => 'required|boolean',
                'is_pest_activity'      => 'required_if:type,Field Audit|boolean',
                'pests_list'            => 'string|nullable',
                'pests_list'            =>  New RequiredPestActivityField($this->is_pest_activity, $this->type),
                'is_office_contact'     => 'required_if:type,Field Audit|boolean',
                'pest_activity_areas'   => 'string|required_if:is_office_contact,1',
                'is_quality_inspection' => 'required_if:type,Field Audit|boolean',
                'name'                  => 'required|string',
                'title'                 => 'required|string',
                'survey_date'           => 'required|date_format:Y-m-d'

            ];
    }

}
