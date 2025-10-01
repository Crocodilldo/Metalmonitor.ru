<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiServices\AuthService;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(
        LoginRequest $request,
        AuthService $auth
    ) {
        return $auth->login($request);
    }

    public function logout(
        Request $request,
        AuthService $auth
    ) {
        return $auth->logout($request);
    }
}
