<?php

namespace App\Repositories;

use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class OrderRepository
{
    /**
     * Create an order from a dash button.
     */
    public function createDashOrder(User $user, Product $product, int $quantity = 1): Order
    {
        $order = DB::transaction(function () use ($user, $product, $quantity) {
            $order = new Order();
            $order->user()->associate($user);
            $order->save();

            $item = new OrderItem();
            $item->product()->associate($product);
            $item->amount = $product->price;
            $item->currency = $product->currency;
            $item->quantity = $quantity;

            $order->items()->save($item);

            return $order;
        });

        Log::debug('Created a new order.', [
            'order_id' => $order->id,
            'user_id' => $order->user->id,
        ]);

        return $order;
    }

    /**
     * Set an order status to STATUS_PAID.
     */
    public function setOrderPaid(Order $order, bool $charged): Order
    {
        if ($order->status === Order::STATUS_PAID) {
            return $order;
        }

        if ($charged) {
            $order->status = Order::STATUS_PAID;
            Log::debug("Set order #{$order->id} to status STATUS_PAID.");
        } else {
            $order->status = Order::STATUS_PAYMENT_REJECTED;
            Log::debug("Set order #{$order->id} to status STATUS_PAYMENT_REJECTED.");
        }

        $order->save();

        return $order;
    }

    /**
     * Cancel an order.
     */
    public function cancelOrder(Order $order): Order
    {
        $order->status = Order::STATUS_CANCELED;
        $order->save();

        Log::debug("Order #{$order->id} was canceled.");

        return $order;
    }
}
