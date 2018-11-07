<?php

namespace App\Http\Controllers;

use App\Events\OrderPaid;
use App\Order;
use App\Repositories\OrderRepository;
use App\Services\Payment;
use App\Workflows\OrderFromDashButton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

final class PayForOrder extends Controller
{
    /**
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function __invoke(Request $request, OrderRepository $orderRepository, Payment $payment)
    {
        $order = Order::find((int) $request->route('id'));
        abort_unless($order, 404);

        if ($request->isMethod('post')) {
            $charged = $payment->chargeCustomerForOrderUsingPaymentDetails($order, $request->only([
                'cc_number',
                'cc_cvv',
                'cc_valid_month',
                'cc_valid_year',
            ]));

            if ($charged) {
                Log::debug('Order was charged to customer. Sending OrderPaid event to the workflow.');

                OrderFromDashButton::whereId($order->id)->send(new OrderPaid());

                return redirect()->route('order.confirmation', ['id' => $order->id]);
            }
        }

        return view('order.payment', ['order' => $order, 'error' => (isset($charged) ? !$charged : false)]);
    }
}
