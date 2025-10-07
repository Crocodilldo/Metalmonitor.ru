<?php

namespace App\Http\Controllers;

use App\Actions\PriceListScandirAction;
use App\Actions\ProductsExelExportAction;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class TestController extends Controller
{
    public function test(ProductsExelExportAction $products_exel_export_action, 
                            Carbon $carbon,
                            PriceListScandirAction $scandir)
    {
       return $products_exel_export_action->handle($carbon, $scandir);
    }
}
