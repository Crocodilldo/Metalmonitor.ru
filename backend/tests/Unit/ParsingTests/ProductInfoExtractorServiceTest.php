<?php

namespace Tests\Unit\ParsingTests;

use App\Services\ParsingServices\ProductInfoExtractorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class ProductInfoExtractorServiceTest extends TestCase
{
    private ProductInfoExtractorService $extractor;
    private Crawler $crawler;

    protected function setUp(): void
    {
        $this->extractor = new ProductInfoExtractorService();
        $html = '<html>
                    <body>
                        <div class="product">Труба профильная 20х20 мм</div>
                        <div class="product">Труба профильная 40х20 мм</div>
                        <span class="price">123 р</span>
                        <span class="price"></span>
                        <a class="link" href="/square_pipe/1"> Труба профильная 20х20 мм</a>
                        <a class="link" href="/square_pipe/2">Труба профильная 40х20 мм</a>
                    </body>
                </html>';

        $this->crawler = new Crawler($html);
    }

    public function test_extracts_information(): void
    {
        $result = $this->extractor->extractInformation($this->crawler, '.product');

        $this->assertEquals(['Труба профильная 20х20 мм', 'Труба профильная 40х20 мм'], $result);
    }

    public function test_extracts_prices(): void
    {
        $result = $this->extractor->extractPrices($this->crawler, '.price');

        $this->assertEquals([123.0, '-'], $result);
    }

    public function test_extracts_urls(): void
    {
        $result = $this->extractor->extractUrls($this->crawler, '.link');

        $this->assertEquals(['/square_pipe/1', '/square_pipe/2'], $result);
    }
}