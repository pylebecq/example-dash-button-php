<?php

namespace App\Tasks;

use App\Mail\OrderInvoice;
use App\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Zenaton\Interfaces\TaskInterface;
use Zenaton\Traits\Zenatonable;

final class SendOrderInvoice implements TaskInterface
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
        Log::debug('Sending invoice to customer.');

        Mail::to($this->order->user->email)
            ->send(new OrderInvoice($this->order))
        ;
    }
}
