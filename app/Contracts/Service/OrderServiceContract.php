<?php

namespace App\Contracts\Service;

/**
 * Here we can specify a set of service methods for Order retrieval & persistence.
 */
interface OrderServiceContract
{
    /**
     * Checkout order.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function checkout(): void;

    /**
     * Make order payment.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function makePayment(): void;
}
