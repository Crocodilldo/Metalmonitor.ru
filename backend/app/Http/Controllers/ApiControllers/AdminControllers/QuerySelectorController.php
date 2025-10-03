<?php

namespace App\Http\Controllers\ApiControllers\AdminControllers;

use App\Models\QuerySelector;
use App\Http\Requests\QuerySelectorStoreRequest;
use App\Http\Requests\QuerySelectorUpdateRequest;
use App\Http\Resources\QuerySelectorResource;

class QuerySelectorController extends BaseCRUDController
{
    protected $model = QuerySelector::class;
    protected $storeRequest = QuerySelectorStoreRequest::class;
    protected $updateRequest = QuerySelectorUpdateRequest::class;
    protected $resource = QuerySelectorResource::class;
}
