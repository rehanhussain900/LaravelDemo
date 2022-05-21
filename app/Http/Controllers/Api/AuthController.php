<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login( LoginRequest $request )
    {
        $user = User::with(['roles', 'branches'])->where( 'email', $request->email )->first();

        if( !$user || !Hash::check( $request->password, $user->password ) ) {
            throw ValidationException::withMessages( [
                'email' => [ 'The provided credentials are incorrect.' ],
            ] );
        }
        $user->token = $user->createToken( $request->device_name )->plainTextToken;
        return new JsonResponse( $user );
    }// login

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function forgetPassword( Request $request )
    {
        $request->validate( [ 'email' => 'required|email' ] );

        $status = Password::sendResetLink(
            $request->only( 'email' )
        );

        if( $status === Password::RESET_LINK_SENT ) {
            return new JsonResponse( [ 'status' => __( $status ) ] );
        }

        return new JsonResponse( [ 'errors' => [ 'email' => __( $status ) ] ], HttpStatus::BadRequest );
    }// forgetPassword
}
