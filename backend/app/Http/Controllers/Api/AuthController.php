<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthRequest;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthRequest $data)
    {
        $user = $this->authValidation($data->only('email', 'password'));
        $user->load('profiles');
        $token = $user->createToken('auth_token')->accessToken;

        return [
            'access_token' => $token,
            'user' => $user
        ];
    }

    private function authValidation($credentials)
    {
        if (!Auth::attempt($credentials))
            throw new Exception("Invalid credentials", 400);

        return Auth::user();
    }
}
