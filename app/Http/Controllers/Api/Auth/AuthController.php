<?php

namespace App\Http\Controllers\Api\Auth;

use App\Builder\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!$token = auth('api')->attempt($credentials)) {
            return ReturnMessage::message(
                false,
                'Unauthorized',
                'Unauthorized',
                null,
                null,
                401
            );
        }

        $response = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
        return ReturnMessage::message(
            false,
            null,
            null,
            null,
            $response,
            200
        );
    }
}
