<?php

namespace App\Contracts\Service;

/**
 * Here we can specify a set of methods for third-party payment services.
 */
interface PaymentServiceContract
{
    /**
     * Make a payment to an external service.
     *
     * @return void
     */
    public function makePayment(): string;
}
