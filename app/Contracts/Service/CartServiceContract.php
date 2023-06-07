<?php

namespace App\Contracts\Service;

/**
 * Here we can specify a set of service methods for Cart retrieval & persistence.
 */
interface CartServiceContract
{
    /**
     * Save a new cart filled with products.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function store(): void;
}
