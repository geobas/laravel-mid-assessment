<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contracts\Service\CustomerServiceContract;

/**
 * This command adds new customers to database.
 */
class AddCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-customers {count=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create dummy customers by supplying the total number of customers to be created (default 5).';

    /**
     * Execute the console command.
     */
    public function handle(CustomerServiceContract $service)
    {
        $service->store($this->argument('count'));

        $this->info('Customers were created successfully.');
    }
}
