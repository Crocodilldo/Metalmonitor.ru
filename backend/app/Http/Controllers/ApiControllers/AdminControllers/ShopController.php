<?php

namespace App\Http\Controllers\ApiControllers\AdminControllers;

use App\Models\Shop;
use App\Http\Requests\ShopStoreRequest;
use App\Http\Requests\ShopUpdateRequest;
use App\Http\Resources\ShopResource;

class ShopController extends BaseCRUDController
{
    protected $model = Shop::class;
    protected $storeRequest = ShopStoreRequest::class;
    protected $updateRequest = ShopUpdateRequest::class;
    protected $resource = ShopResource::class;
}
