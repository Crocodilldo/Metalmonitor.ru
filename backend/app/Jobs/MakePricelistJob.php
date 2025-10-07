<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MakePricelistJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle($products_exel_export_action, 
                            $carbon,
                            $scandir): void
    {
       $products_exel_export_action->handle($carbon, $scandir);
    }
}
