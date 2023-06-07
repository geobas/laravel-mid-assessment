<?php

namespace App\Console\Commands;

use App\Contracts\Service\OrderServiceContract;
use App\Services\OrderService;
use Illuminate\Console\Command;

class AddOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new order for a newly created cart.';

    /**
     * Execute the console command.
     */
    public function handle(OrderServiceContract $service)
    {
        $service->checkout();

        $this->info('A new order was placed successfully.');
    }
}
