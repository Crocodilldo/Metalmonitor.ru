<?php

namespace App\Services\ParsingServices;

use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;
use Throwable;


class GetContentService
{

    public function getSiteContent(?string $url)
    {
        if (empty($url)) {
            Log::error('Fetch site content failed', [
                'url' => $url,
                'message' => 'URL is empty',
            ]);
            return null;
        }
        try {
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_COOKIEFILE, '/cookies/cookie.txt');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0');

            $site_content = curl_exec($ch);

            if ($site_content === false) {
                $errorMessage = curl_error($ch);
                curl_close($ch);
                throw new \RuntimeException("cURL error: {$errorMessage}");
            }

            curl_close($ch);

            return new Crawler($site_content);
        } catch (Throwable $e) {
            Log::error('Fetch site content failed', [
                'url' => $url,
                'message' => $e->getMessage(),
            ]);
            return null;
        }
    }
}
