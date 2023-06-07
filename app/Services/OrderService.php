<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Service\OrderServiceContract;
use App\Enums\OrderStatus;
use App\Enums\TransactionStatus;
use App\Exceptions\OrderException;
use App\Exceptions\PaymentException;
use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Product;
use App\Notifications\OrderPaid;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * This is a service that abstracts the retrieval & persistence logic of Order model.
 */
class OrderService implements OrderServiceContract
{
    /**
     * For the assesment's sake the shipping cost is hard-coded.
     */
    const SHIPPING_COST = 30.00;

    public function checkout(): void
    {
        try {
            DB::beginTransaction();
            // All the code beneath is handled as a single transaction
            // thus all queries are treated as one action

            // pick newly created cart
            $cart = Cart::with('cartItems')
                ->latest()
                ->first();

            // create a new order
            $this->createOrder($cart);

            // clear cart
            $cart->delete();

            // commit transaction for persisting data
            DB::commit();
        } catch (Exception $e) {
            // If an exception was thrown, data is not persisted
            DB::rollback();

            // and an OrderException is thrown
            throw new OrderException($e->getMessage());
        }
    }

    public function makePayment(): void
    {
        try {
            DB::beginTransaction();
            // All the code beneath is handled as a single transaction
            // thus all queries are treated as one action

            // get the latest created order
            $order = Order::latest()->first();

            // get details for the selected payment gateway (here 'Credit Card' is hard-coded for the sake of the assessment)
            $paymentGateway = PaymentGateway::whereName('Credit Card')->first();

            // communicate with external service of payment gateway and receive transaction token
            $token = $this->callExternalPaymentService($paymentGateway);

            // create a new transaction
            $order->transactions()->create([
                'customer_id' => $order->customer_id,
                'payment_gateway_id' => $paymentGateway->id,
                'code' => $token,
                'status' => ! empty($token) ? TransactionStatus::SUCCESS : TransactionStatus::FAILED,
            ]);

            // update the order
            $order->update([
                'status' => ! empty($token) ? OrderStatus::PAID : OrderStatus::FAILED,
            ]);

            // commit transaction for persisting data
            DB::commit();

            // send a notification to customer
            $order->notify(new OrderPaid($order));
        } catch (Exception $e) {
            // If an exception was thrown, data is not persisted
            DB::rollback();

            // and a PaymentException is thrown
            throw new PaymentException($e->getMessage());
        }
    }

    /**
     * Creates a new order, adds products from the cart
     * and reduces each product's quantity.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    private function createOrder(Cart $cart): void
    {
        // compute sub total of order items
        $sum = $this->computeSubTotal($cart->cartItems);

        // create a new Order
        $order = Order::create([
            'customer_id' => $cart->customer_id,
            'status' => OrderStatus::NEW,
            'sub_total' => $sum,
            'shipping' => self::SHIPPING_COST,
            'total' => $sum + self::SHIPPING_COST,
        ]);

        // create OrderItems associated with newly created Order
        foreach($cart->cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
            ]);

            // reduce each product's quantity
            Product::findOrFail($item->product_id)
                ->decrement('stock', $item->quantity);
        }
    }

    /**
     * Compute the total price of the Order Items
     * without the shipping cost.
     *
     * @param  \Illuminate\Support\Collection $items
     * @return float
     */
    private function computeSubTotal(Collection $items): float
    {
        $sum = 0;

        foreach($items as $item) {
            $sum += $item->price * $item->quantity;
        }

        return $sum;
    }

    /**
     * Calls the payment gateway and retrieves a unique transaction token.
     *
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return string
     */
    private function callExternalPaymentService(PaymentGateway $paymentGateway): string
    {
        // get an instance of the external payment service
        $externalService = PaymentServiceFactory::getPaymentService($paymentGateway->name);

        // make the actual payment and return the unique token that was retrieved by the external payment service
        return $externalService->makePayment() ?? '';
    }
}
