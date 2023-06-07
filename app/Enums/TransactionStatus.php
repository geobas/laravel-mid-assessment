<?php

namespace App\Enums;

/**
 * A 'backed' Enum with all available transaction statuses.
 */
enum TransactionStatus: string
{
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';
    case PENDING = 'pending';
    case SUCCESS = 'success';

    /**
     * Fetch all available transaction status values.
     *
     * @return array
     */
    public static function fetchValues(): array
    {
        return collect(self::cases())->pluck('value')->all();
    }
}
