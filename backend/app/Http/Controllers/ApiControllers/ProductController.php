<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiServices\ProductsResponseService;

class ProductController extends Controller
{
    public function index(Request $request, ProductsResponseService $productResponse)
    {
        return $productResponse->response($request);
    }
}
