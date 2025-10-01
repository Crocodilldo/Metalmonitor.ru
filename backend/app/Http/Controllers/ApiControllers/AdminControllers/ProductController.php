<?php

namespace App\Http\Controllers\ApiControllers\AdminControllers;

use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;

class ProductController extends BaseCRUDController
{
    protected $model = Product::class;
    protected $storeRequest = ProductStoreRequest::class;
    protected $updateRequest = ProductUpdateRequest::class;
    protected $resource = ProductResource::class;
}
