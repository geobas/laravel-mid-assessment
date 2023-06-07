<?php

namespace App\Enums;

/**
 * A 'backed' Enum with all available order statuses.
 */
enum OrderStatus: string
{
    case NEW = 'new';
    case PAID = 'paid';
    case FAILED = 'failed';
    case COMPLETED = 'completed';
    case SHIPPED = 'shipped';
    case RETURNED = 'returned';

    /**
     * Fetch all available order status values.
     *
     * @return array
     */
    public static function fetchValues(): array
    {
        return collect(self::cases())->pluck('value')->all();
    }
}
