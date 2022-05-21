<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MiscDepositCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch_id'         => 'required',
            'gl_account_number' => 'required|numeric|max:99999',
            'deposit_at'        => 'required|date',
            'amount'            => 'required|numeric',
            'vendor'            => 'required',
        ];
    }
}
