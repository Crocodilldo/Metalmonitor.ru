<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UpdateLink;
use Illuminate\Support\Facades\Log;
use App\Jobs\ParsingProductsJob;

class DispatchParsingJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispatch_parsing_jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatching parsing jobs to queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $links = UpdateLink::select('url', 'shop_id', 'category_id')->get();

        foreach ($links as $link) {
            ParsingProductsJob::dispatch(
                $link->url,
                $link->shop_id,
                $link->category_id
            )->onQueue('default');
        }
        $this->info('All parsing jobs dispatched.');
    }
}
