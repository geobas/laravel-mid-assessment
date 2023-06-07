<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the whole business flow of the application.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('app:add-customers');

        $this->call('app:add-products');

        $this->call('app:add-cart');

        $this->call('app:add-order');

        $this->call('app:order-payment');

        $this->info('The whole order process was completed successfully.');
    }
}
