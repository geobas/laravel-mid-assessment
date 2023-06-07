<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Service\CartServiceContract;
use App\Exceptions\CartException;
use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * This is a service that abstracts the retrieval & persistence logic of Cart model.
 */
class CartService implements CartServiceContract
{
    public function store(): void
    {
        try {
            DB::beginTransaction();
            // All the code beneath is handled as a single transaction
            // thus all queries are treated as one action

            $this->createCartInstance();

            // commit transaction for persisting data
            DB::commit();
        } catch (Exception $e) {
            // If an exception was thrown, data is not persisted
            DB::rollback();

            // and a CartException is thrown
            throw new CartException($e->getMessage());
        }
    }

    /**
     * Creates a new cart instance, selects some products
     * and adds them to that cart.
     *
     * @return void
     */
    private function createCartInstance(): void
    {
        // create a new cart instance
        $cart = Cart::factory()->create();

        // pick 5 random products that are in stock
        $products = Product::inRandomOrder()
            ->where('stock', '>', 0)
            ->limit(5)
            ->get();

        // add those products to newly created cart
        foreach ($products as $product) {
            $cart->cartItems()->create([
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => rand(1, 3),
            ]);
        }
    }
}
