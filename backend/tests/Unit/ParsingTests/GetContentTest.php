<?php

namespace Tests\Unit\ParsingTests;

use PHPUnit\Framework\TestCase;
use App\Services\ParsingServices\GetContentService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class GetContentTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_fetch_content_when_url_is_null(): void
    {
        Log::shouldReceive('error')->once()->withArgs(function ($message, $context) {
            return $message === 'Fetch site content failed' && $context['url'] === null;
        });

        $service = new GetContentService;
        $result = $service->getSiteContent(null);
        $this->assertNull($result);
    }
    public function test_crawler_success(): void
    {
{
    Log::shouldReceive('error')->never();

    $html = '<html><body><form><input type="text" name="text" placeholder="Найдётся всё"></form></body></html>';

    $crawler = new Crawler($html);

    $placeholder = $crawler->filter('input[name="text"]')->attr('placeholder');

    $this->assertEquals('Найдётся всё', $placeholder);
}
    }
}
//TODO: complete tests