<?php

namespace App\Mail;

use App\Order;
use Illuminate\Mail\Mailable;

final class OrderInvoice extends Mailable
{
    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this
            ->view('emails.order_invoice')
            ->with('order', $this->order)
        ;
    }
}
