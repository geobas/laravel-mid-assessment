<?php

namespace App\Console\Commands;

use App\Services\CartService;
use Illuminate\Console\Command;

class AddCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-cart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new cart for a random customer and add some products.';

    /**
     * Execute the console command.
     */
    public function handle(CartService $service)
    {
        $service->store();

        $this->info('A new cart was created successfully.');
    }
}
