<?php

namespace App\Services\ParsingServices;

use Illuminate\Support\Carbon;

class ProductBuilderService
{
    public function build(
        $information,
        $parameters,
        $prices,
        $urls,
        $shopId,
        $categoryId
    ): array {
        $products = [];

        for ($i = 0; $i < count($urls); $i++) {
            $products[] = [
                'name'        => $information[$i] ?? '-',
                'category_id' => $categoryId,
                'shop_id'     => $shopId,
                'parameter'   => $parameters[$i] ?? '-',
                'price'       => $prices[$i] ?? '-',
                'url'         => $urls[$i] ?? '-',
                'updated_at'  => Carbon::now()->toDateTimeString(),
            ];
        }

        return $products;
    }
}
