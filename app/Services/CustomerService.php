<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;

/**
 * This is a service that abstracts the retrieval & persistence logic of Customer model.
 */
class CustomerService implements CustomerServiceContract
{
    public function store(int $count): void
    {
        // create dummy customers
        Customer::factory($count)->make()->each(fn ($customer) => $customer->save());
    }
}
