<?php

namespace App\Http\Controllers;

use App\Services\ParsingServices\ParsingService;
use App\Models\UpdateLink;
use Illuminate\Support\Facades\Auth;


class TestController extends Controller
{
    public function test()
    {
        if (Auth::check()) {
            // Пользователь авторизован, выполнить действия для авторизованных пользователей
            return 'Пользователь авторизован!';
        } else {
            // Пользователь не авторизован, выполнить действия для неавторизованных пользователей
            return 'Пользователь не авторизован.';
        }
    }
}
