<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuerySelectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [   //FormulaM2
                'shop_id'=>'1',
                'product_information'=>'.js-toclamp-4',
                'price'=>'.product-card__new-price span:not([class])',
                'url'=>'.product-card__title a',
            ],

            [   //Arsenal
                'shop_id'=>'2',
                'product_information'=>'.product-block .description h3',
                'price'=>'.price-by-card .js-value',
                'url'=>'.product-block .description h3 a',
            ],

            [   //MXT22
                'shop_id'=>'3',
                'product_information'=>'.i-hate-metal',
                'price'=>'.unit2',
                'url'=>'.i-hate-metal',
            ]
            ];
            foreach ($data as $selector)
            DB::table('query_selectors')->insert([
                'shop_id'=>$selector['shop_id'],
                'product_information'=>$selector['product_information'],
                'price'=>$selector['price'],
                'url'=>$selector['url'],
                'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
