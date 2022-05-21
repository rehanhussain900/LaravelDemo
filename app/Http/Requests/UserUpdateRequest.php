<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Laravel\Fortify\Rules\Password;

class UserUpdateRequest extends FormRequest
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
        $user = $this->route( 'user' );
        return [
            'name'          => [ 'required', 'string', 'max:255' ],
            'email'         => [ 'required', 'string', 'email', 'max:255', Rule::unique( 'users' )->ignore( $user->id ) ],
            'password'      => [ 'sometimes', 'confirmed' ],
            'roles'         => [ 'required' ],
            'description'   => [ 'string' ]
        ];
    }
}