<?php

namespace App\Tasks;

use App\Order;
use App\Repositories\OrderRepository;
use App\Services\Payment;
use Illuminate\Support\Facades\App;
use Zenaton\Interfaces\TaskInterface;
use Zenaton\Traits\Zenatonable;

final class ChargeCustomerForOrder implements TaskInterface
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
        /** @var Payment $psp */
        $psp = App::make(Payment::class);

        $charged = $psp->chargeCustomerForOrder($this->order);
        /** @var OrderRepository $repository */
        $repository = App::make(OrderRepository::class);
        $repository->setOrderPaid($this->order, $charged);

        return $charged;
    }
}
