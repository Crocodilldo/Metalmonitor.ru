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
    public function __construct(
        private GetContentService $fetcher,
        private ProductInfoExtractorService $extractor,
        private ProductParameterNormalizerService $normalizer,
        private ProductBuilderService $builder,
        private ProductStoreService $store,
    ) {}

    public function parseProducts($url, $shopId, $categoryId): void
    {
        Log::info('Parsing started', compact('url', 'shopId'));

        $crawler = $this->fetcher->getSiteContent($url);
        if (!$crawler) {
            return;
        }
        $selectors = PhpQuerySelector::where('shop_id', $shopId)->firstOrFail();

        $information = $this->extractor->extractInformation($crawler, $selectors->product_information);
        $parameters  = $this->normalizer->normalize($information);
        $prices      = $this->extractor->extractPrices($crawler, $selectors->price);
        $urls        = $this->extractor->extractUrls($crawler, $selectors->url);

        $products = $this->builder->build($information, $parameters, $prices, $urls, $shopId, $categoryId);

        if (empty($products)) {
            Log::info('No parsing result on: ' . $url);
            return;
        }
        $this->store->save($products);
        Log::info('Parsing finished');
    }
}
