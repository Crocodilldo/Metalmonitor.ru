<?php

namespace Tests\Feature\ParsingTests;

use Tests\TestCase;
use App\Services\ParsingServices\GetContentService;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class GetContentGoogleFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
public function test_fetch_content_from_google(): void
{
    Log::shouldReceive('error')->never();

    $service = new GetContentService;
    $result = $service->getSiteContent('https://www.google.com');

    $this->assertInstanceOf(Crawler::class, $result);

    // Проверяем, что title содержит "Google"
    $title = $result->filter('title')->text();
    $this->assertStringContainsString('Google', $title);
}
}
