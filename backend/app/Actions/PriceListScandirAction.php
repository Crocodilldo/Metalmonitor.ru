<?php

namespace App\Actions;


class PriceListScandirAction
{
    public function handle(){
        $filename=scandir('/var/www/html/storage/app/public/PriceLists/');
        $filename=implode(array_diff($filename, ['.', '..']));
        return $filename;
    }
}
