<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\MakePricelistJob;
use App\Actions\ProductsExelExportAction;
use Illuminate\Support\Carbon;
use App\Actions\PriceListScandirAction;

class MakePricelistCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make_pricelist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pricelist Export';

    /**
     * Execute the console command.
     */
    public function handle(
        MakePricelistJob $make_pricelist_job,
        ProductsExelExportAction $products_exel_export_action,
        Carbon $carbon,
        PriceListScandirAction $scandir
    ) {
        $make_pricelist_job->handle(
            $products_exel_export_action,
            $carbon,
            $scandir
        );
        $this->info('Pricelist created.');
    }
}
