<?php

namespace App\Services;

use App\Contracts\Service\PaymentServiceContract;

/**
 * This is a service that mocks the communication logic with PayPal.
 */
class PaypalService implements PaymentServiceContract
{
    /**
     * Communicate with PayPal and get a unique transaction token.
     *
     * @return string
     */
    public function makePayment(): string
    {
        return md5(rand(1, 10) . microtime());
    }
}
