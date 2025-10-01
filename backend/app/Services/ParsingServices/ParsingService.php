<?php

namespace App\Services\ParsingServices;

use App\Models\PhpQuerySelector;
use Illuminate\Support\Facades\Log;
use App\Services\ParsingServices\ProductInfoExtractorService;
use App\Services\ParsingServices\ProductParameterNormalizerService;
use App\Services\ParsingServices\ProductBuilderService;
use App\Services\ParsingServices\ProductStoreService;

class ParsingService
{
    public function parseProducts(
        $url,
        $shopId,
        $categoryId,
        GetContentService $fetcher,
        ProductInfoExtractorService $extractor,
        ProductParameterNormalizerService $normalizer,
        ProductBuilderService $builder,
        ProductStoreService $store
    ): void {
        Log::info('Parsing started', compact('url', 'shopId'));

        $crawler = $fetcher->getSiteContent($url);
        if (!$crawler) {
            return;
        }
        $selectors = PhpQuerySelector::where('shop_id', $shopId)->firstOrFail();

        $information = $extractor->extractInformation($crawler, $selectors->product_information);
        $parameters  = $normalizer->normalize($information);
        $prices      = $extractor->extractPrices($crawler, $selectors->price);
        $urls        = $extractor->extractUrls($crawler, $selectors->url);

        $products = $builder->build($information, $parameters, $prices, $urls, $shopId, $categoryId);

        if (empty($products)) {
            Log::info('No parsing result on: ' . $url);
            return;
        }
        $store->save($products);
        Log::info('Parsing finished');
    }
}
