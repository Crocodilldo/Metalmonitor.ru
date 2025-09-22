<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\ParsingServices\ParsingService;
use App\Services\ParsingServices\GetContentService;
use Illuminate\Support\Facades\Log;

class ParsingProductsJob implements ShouldQueue
{
    use Queueable;

    public string $url;
    public int $shop_id;
    public int $category_id;

    /**
     * Create a new job instance.
     */
    public function __construct($url, $shop_id, $category_id)
    {
        $this->url = $url;
        $this->shop_id = $shop_id;
        $this->category_id = $category_id;
    }
    /**
     * Execute the job.
     */
    public function handle(
        ParsingService $parsing_service,
        GetContentService $service,
    ): void {
        $starttime = microtime(true);
        $parsing_service->parseProducts(
            $service,
            $this->url,
            $this->shop_id,
            $this->category_id
        );
        Log::info('Parsing finished in: ' . microtime(true) - $starttime . ' sec.');
    }
}
