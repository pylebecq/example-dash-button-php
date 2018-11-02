<?php

namespace App\Services;

use App\Order;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Log;

final class Payment
{
    /** @var OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function chargeCustomerForOrder(Order $order): bool
    {
        // Let's pretend we have the credit card details saved somewhere and we are able to charge without any user input.
        sleep(1);

        Log::debug('Charging customer with saved payment details', ['order_id' => $order->id, 'user_id' => $order->user->id]);

        $result = true;
        if ($result) {
            Log::debug('Order was successfully charged to customer', ['order_id' => $order->id]);
        } else {
            Log::debug('Could not charge customer for order', ['order_id' => $order->id]);
        }

        return $result;
    }

    public function chargeCustomerForOrderUsingPaymentDetails(Order $order, array $paymentDetails): bool
    {
        // If the credit card number ends with an even digit, we consider it a success. Otherwise, it's a failure.
        $result = (int) substr($paymentDetails['cc_number'], -1, 1) % 2 === 0 ? true : false;

        $this->orderRepository->setOrderPaid($order, $result);

        return $result;
    }
}
