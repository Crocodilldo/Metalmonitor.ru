<?php

namespace App\Http\Controllers\ApiControllers\AdminControllers;

use App\Models\UpdateLink;
use App\Http\Requests\UpdateLinkStoreRequest;
use App\Http\Requests\UpdateLinkUpdateRequest;
use App\Http\Resources\UpdateLinkResource;

class UpdateLinkController extends BaseCRUDController
{
    protected $model = UpdateLink::class;
    protected $storeRequest = UpdateLinkStoreRequest::class;
    protected $updateRequest = UpdateLinkUpdateRequest::class;
    protected $resource = UpdateLinkResource::class;
}
