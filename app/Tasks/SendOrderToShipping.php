<?php

namespace App\Tasks;

use App\Order;
use Illuminate\Support\Facades\Log;
use Zenaton\Interfaces\TaskInterface;
use Zenaton\Traits\Zenatonable;

final class SendOrderToShipping implements TaskInterface
{
    use Zenatonable;

    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        // A normal implementation would make an HTTP request somewhere to inform the order was paid
        // but for this example we will fake it by sleeping 1s only.
        sleep(1);

        Log::debug("Order #{$this->order->id} was sent to shipping.");
    }
}
