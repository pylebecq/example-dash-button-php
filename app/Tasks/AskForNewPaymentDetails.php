<?php

namespace App\Tasks;

use App\Mail\AskForNewPaymentDetails as AskForNewPaymentDetailsMail;
use App\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Zenaton\Interfaces\TaskInterface;
use Zenaton\Traits\Zenatonable;

final class AskForNewPaymentDetails implements TaskInterface
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
        Log::debug('Asking customer for new payment details using email.');

        Mail::to($this->order->user->email)
            ->send(new AskForNewPaymentDetailsMail($this->order))
        ;
    }
}
