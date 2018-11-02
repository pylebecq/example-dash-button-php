<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\OrderRepository;
use App\User;
use App\Workflows\OrderFromDashButton as OrderFromDashButtonWorkflow;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class OrderFromDashButton extends Controller
{
    public function __invoke(Request $request, OrderRepository $orderRepository): Response
    {
        $user = User::find((int) $request->header('X-User-Id'));
        abort_unless($user, 403);

        $product = Product::find((int) $request->json('product_id'));
        abort_unless($product, 400);

        $order = $orderRepository->createDashOrder($user, $product, $request->json('quantity', 1));

        (new OrderFromDashButtonWorkflow($order))->dispatch();

        return response($order, 201);
    }
}
