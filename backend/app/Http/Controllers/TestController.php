<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ParsingServices\GetContentService;

class TestController extends Controller
{
    public function test(GetContentService $service){
        $result=$service->getSiteContent(null);
        return var_dump($result);
        
    }
}
