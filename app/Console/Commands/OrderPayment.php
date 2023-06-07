<?php

namespace App\Console\Commands;

use App\Contracts\Service\OrderServiceContract;
use App\Services\OrderService;
use Illuminate\Console\Command;

class OrderPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:order-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proceed with the order payment.';

    /**
     * Execute the console command.
     */
    public function handle(OrderServiceContract $service)
    {
        $service->makePayment();

        $this->info('The order was paid successfully and the customer was notified.');
    }
}
