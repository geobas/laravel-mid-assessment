<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

/**
 * This command adds new products to database.
 */
class AddProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-products {count=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create dummy products by supplying the total number of products to be created (default 10).';

    /**
     * Execute the console command.
     */
    public function handle(ProductService $service)
    {
        $service->store($this->argument('count'));

        $this->info('Products were created successfully.');
    }
}
