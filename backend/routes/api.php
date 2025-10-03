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


Route::prefix('/admin')->middleware('auth:sanctum')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\ApiControllers\AuthController@logout');

    Route::apiResource('/shops', 'App\Http\Controllers\ApiControllers\AdminControllers\ShopController');
    Route::apiResource('/updateLinks', 'App\Http\Controllers\ApiControllers\AdminControllers\UpdateLinkController');
    Route::apiResource('/categories', 'App\Http\Controllers\ApiControllers\AdminControllers\CategoryController');
    Route::apiResource('/products', 'App\Http\Controllers\ApiControllers\AdminControllers\ProductController');
    Route::apiResource('/selectors', 'App\Http\Controllers\ApiControllers\AdminControllers\QuerySelectorController');
});
