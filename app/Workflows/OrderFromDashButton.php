<?php

namespace App\Workflows;

use App\Events\OrderPaid;
use App\Order;
use App\Tasks\AskForNewPaymentDetails;
use App\Tasks\CancelOrder;
use App\Tasks\ChargeCustomerForOrder;
use App\Tasks\SendOrderInvoice;
use App\Tasks\SendOrderToShipping;
use Zenaton\Interfaces\WorkflowInterface;
use Zenaton\Tasks\Wait;
use Zenaton\Traits\Zenatonable;

final class OrderFromDashButton implements WorkflowInterface
{
    use Zenatonable;

    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $charged = (new ChargeCustomerForOrder($this->order))->execute();
        $event = null;
        if (!$charged) {
            // We could not charge the customer using it's saved payment details, let's ask for new ones
            (new AskForNewPaymentDetails($this->order))->dispatch();
            $event = (new Wait(OrderPaid::class))->days(14)->execute();
        }

        if ($charged || $event) {
            // Order was charged from saved payment details or paid by the customer using payment form,
            // we can now send the invoice and ship it!
            (new SendOrderInvoice($this->order))->dispatch();
            (new SendOrderToShipping($this->order))->dispatch();
        } else {
            (new CancelOrder($this->order))->dispatch();
        }
    }

    public function getId()
    {
        return $this->order->id;
    }
}
