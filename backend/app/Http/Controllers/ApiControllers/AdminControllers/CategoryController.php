<?php

namespace App\Http\Controllers\ApiControllers\AdminControllers;

use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends BaseCRUDController
{
    protected $model = Category::class;
    protected $storeRequest = CategoryStoreRequest::class;
    protected $updateRequest = CategoryUpdateRequest::class;
    protected $resource = CategoryResource::class;
}
