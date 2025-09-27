<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::middleware('auth:sanctum')->get('/test', 'App\Http\Controllers\TestController@test');


Route::get('/products', 'App\Http\Controllers\ApiControllers\ProductController@index');

Route::post('/login', 'App\Http\Controllers\ApiControllers\AuthController@login');

Route::middleware('auth:sanctum')->post('/logout', 'App\Http\Controllers\ApiControllers\AuthController@logout');
