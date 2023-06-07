<?php

namespace App\Contracts\Service;

/**
 * Here we can specify a set of service methods for Customer retrieval & persistence.
 */
interface CustomerServiceContract
{
    /**
     * Save new customers.
     *
     * @param  int  $count
     * @return void
     */
    public function store(int $count): void;
}
