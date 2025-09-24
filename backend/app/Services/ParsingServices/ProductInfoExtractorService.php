<?php

namespace App\Services\ParsingServices;

use Symfony\Component\DomCrawler\Crawler;

class ProductInfoExtractorService
{
    public function extractInformation(Crawler $crawler, string $selector): array
    {
        return $crawler->filter($selector)->each(function (Crawler $node) {
            return trim($node->text());
        });
    }

    public function extractPrices(Crawler $crawler, string $selector): array
    {
        return $crawler->filter($selector)->each(function (Crawler $node) {
            $text = trim($node->text());
            return $text !== '' ? (float) str_replace(' ', '', $text) : '-';
        });
    }

    public function extractUrls(Crawler $crawler, string $selector): array
    {
        return $crawler->filter($selector)->each(function (Crawler $node) {
            return $node->attr('href');
        });
    }
}
