<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Service\ProductServiceContract;
use App\Models\Product;

/**
 * This is a service that abstracts the retrieval & persistence logic of Product model.
 */
class ProductService implements ProductServiceContract
{
    public function store(int $count): void
    {
        // create dummy products
        Product::factory($count)->make()->each(fn ($product) => $product->save());
    }
}
