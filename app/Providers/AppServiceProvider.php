<?php

namespace App\Providers;

use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\OrderServiceContract;
use App\Services\CustomerService;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Bind 'customer service contract' to a concrete implementation class.
         * In that way we can switch different implementations of 'customer service'
         * at run-time, without updating the code where 'customer service contract'
         * is injected.
         */
        $this->app->bind(CustomerServiceContract::class, function () {
            return new CustomerService;
        });

        $this->app->bind(OrderServiceContract::class, function () {
            return new OrderService;
        });
    }
}
