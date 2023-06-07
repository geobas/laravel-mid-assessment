<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Service\PaymentServiceContract;
use App\Services\BankService;
use App\Services\PaypalService;

class PaymentServiceFactory
{
    /**
     * Returns an instance of an external payment service.
     *
     * @param  string  $serviceName
     * @return \App\Contracts\Service\PaymentServiceContract
     */
    public static function getPaymentService(string $serviceName): PaymentServiceContract
    {
        return match ($serviceName) {
            'Credit Card' => new BankService,
            'Debit Card' => new BankService,
            'PayPal' => new PaypalService,
        };
    }
}
