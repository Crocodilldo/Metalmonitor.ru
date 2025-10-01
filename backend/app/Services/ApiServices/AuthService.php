<?php

namespace App\Services\ApiServices;

use Illuminate\Support\Facades\Auth;


class AuthService
{

    public function login($request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
            return response()->json('Wrong email or password', 401);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function logout($request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
