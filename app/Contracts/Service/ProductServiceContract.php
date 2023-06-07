<?php

namespace App\Contracts\Service;

/**
 * Here we can specify a set of service methods for Product retrieval & persistence.
 */
interface ProductServiceContract
{
    /**
     * Create new products.
     *
     * @param  int  $count
     * @return void
     */
    public function store(int $count): void;
}
