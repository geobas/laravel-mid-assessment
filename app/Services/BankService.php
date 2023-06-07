<?php

namespace App\Services;

use App\Contracts\Service\PaymentServiceContract;

/**
 * This is a service that mocks the communication logic with bank gateways.
 */
class BankService implements PaymentServiceContract
{
    /**
     * Communicate with a bank gateway and get a unique transaction token.
     *
     * @return string
     */
    public function makePayment(): string
    {
        return md5(rand(1, 10) . microtime());
    }
}
