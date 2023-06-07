<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;
use ReflectionClass;
use Exception;

/**
 * Custom exception for handling payment gateway errors.
 */
class PaymentException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report(): void
    {
        Log::error((new ReflectionClass($this))->getShortName() . ': ' . $this->getMessage());
    }
}
