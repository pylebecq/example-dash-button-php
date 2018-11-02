<?php

namespace App\Tasks;

use App\Order;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\App;
use Zenaton\Interfaces\TaskInterface;
use Zenaton\Traits\Zenatonable;

final class CancelOrder implements TaskInterface
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
        /** @var OrderRepository $repository */
        $repository = App::make(OrderRepository::class);
        $repository->cancelOrder($this->order);
    }
}
