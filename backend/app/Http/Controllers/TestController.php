<?php

namespace App\Http\Controllers;

use App\Services\ParsingServices\GetContentService;
use App\Models\PhpQuerySelector;
use App\Models\Product;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;


class TestController extends Controller
{
    public function test() {}
}
