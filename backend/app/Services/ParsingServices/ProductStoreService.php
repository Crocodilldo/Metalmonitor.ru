<?php

namespace App\Services\ParsingServices;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductStoreService
{
    public function save(array $products): void
    {
        foreach ($products as $product) {
            Product::updateOrCreate(
                ['url' => $product['url']],
                $product
            );
            Log::info($product);

        }
    }
}
