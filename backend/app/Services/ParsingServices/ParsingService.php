<?php

namespace App\Services\ParsingServices;

use App\Models\PhpQuerySelector;
use App\Models\Product;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;



class ParsingService
{
    public function parseProducts(
        $service,
        $url,
        $shop_id,
        $category_id

    ): void {
        Log::info('Parsing started', [
            'url' => $url,
            'shop_id' => $shop_id,
        ]);
        $site_content = $service->getSiteContent($url);
        if (empty($site_content)) return;
        $selectors = PhpQuerySelector::where('shop_id', $shop_id)->get()->toArray();

        // Получение информации о продукте
        $products_information = [];
        $site_content->filter($selectors[0]['product_information'])->each(function (Crawler $node) use (&$products_information) {
            $products_information[] = trim($node->text());
        });

        //Присвоение параметров продукта
        foreach ($products_information as $product_for_parsing) {
            $product_for_parsing = str_replace(['х', 'x', 'х', '/'], '*', $product_for_parsing);
            $product_for_parsing = str_replace('мм', '', $product_for_parsing);
            $product_for_parsing = str_replace('.', ',', $product_for_parsing);
            preg_match(
                '/([0-9]+)?,?([0-9]+)?\*?([0-9]+)?,?([0-9]+)?\*?([0-9]+),?([0-9]+)?/',
                $product_for_parsing,
                $received_parameter
            );
            $received_parameter = trim($received_parameter[0], ' \,');
            $product_parameter = explode('*', $received_parameter);
            $product_parameter = str_replace(',', '.', $product_parameter);
            $product_parameter  = array_map('floatval',  $product_parameter);
            rsort($product_parameter, SORT_NUMERIC);
            $products_parameters[] = implode('*', $product_parameter);
        }

        //получение цены
        $prices = $site_content
            ->filter($selectors[0]['price'])
            ->each(function (Crawler $node) {
                $text = trim($node->text());
                return $text !== ''
                    ? (float) str_replace(' ', '', $text)
                    : '-';
            });

        //получение ссылки на товар
        $product_url = $site_content
            ->filter($selectors[0]['url'])
            ->each(function (Crawler $node) {
                return $node->attr('href');
            });

        unset($site_content);

        //создание массива товаров для добавления в БД
        for ($i = 0; $i < count($product_url); $i++) {
            $product[$i] = [
                'name' => $products_information[$i],
                'category_id' => $category_id,
                'shop_id' => $shop_id,
                'parameter' => $products_parameters[$i],
                'price' => $prices[$i],
                'url' => $product_url[$i],
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }
        if (empty($product)) {
            Log::info('No parsing result on: ' . $url);
            return;
        }
        //запись результатов в БД
        foreach ($product as $pr) {
            Product::updateOrCreate(
                ['url' => $pr['url']],
                $pr
            );
        }
        Log::info($product);
    }
}
    //TODO: Decompose this service