<?php

namespace App\Actions;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExelExport;
use App\Actions\PriceListScandirAction;
use Carbon\Carbon;

class ProductsExelExportAction
{
    public function handle(Carbon $carbon,PriceListScandirAction $scandir){

            $old_pricelist=$scandir->handle();
            $date=$carbon->now()->toDateString();
            
            if (!empty($old_pricelist))
                {
                    rename('/var/www/html/storage/app/public/PriceLists/'.$old_pricelist, 
                        '/var/www/html/storage/app/public/OldPriceLists/'.$old_pricelist);
                    return Excel::store(new ProductExelExport, 'PriceLists\Metalmonitor_pricelist_'.$date.'.xlsx', 'public');
                }
            else
                return Excel::store(new ProductExelExport, 'PriceLists\Metalmonitor_pricelist_'.$date.'.xlsx', 'public');
        
    }
}
