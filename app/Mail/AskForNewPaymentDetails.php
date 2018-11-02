<?php

namespace App\Mail;

use App\Order;
use Illuminate\Mail\Mailable;

final class AskForNewPaymentDetails extends Mailable
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
            ->view('emails.ask_for_new_payment_details')
            ->with('order', $this->order)
        ;
    }
}
