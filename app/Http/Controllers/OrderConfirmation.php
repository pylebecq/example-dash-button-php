<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\OrderRepository;
use App\Services\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class OrderConfirmation extends Controller
{
    public function __invoke(Request $request, OrderRepository $orderRepository, Payment $payment): View
    {
        $order = Order::find((int) $request->route('id'));
        abort_unless($order, 404);

        return view('order.confirmation', ['order' => $order]);
    }
}
