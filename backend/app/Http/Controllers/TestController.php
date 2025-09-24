<?php

namespace App\Http\Controllers;

use App\Services\ParsingServices\ParsingService;
use App\Models\UpdateLink;


class TestController extends Controller
{
    public function test(ParsingService $service) {

        $links = UpdateLink::all(['url', 'shop_id', 'category_id']);
        foreach ($links as $link) {
            $service->parseProducts($link->url, $link->shop_id, $link->category_id);
        };
    }//TODO:Complete test
}
