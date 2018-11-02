Hello {{ $order->user->name }},

You recently puchased the following product using your Dash button:

@foreach ($order->items as $item)
    - Product #{{ $item->product->id }} x{{ $item->quantity }} : {{ number_format($item->total / 100, 2) }}
@endforeach

Unfortunately, we were not able to charge your credit card.
Please use the following link to pay for your order: <a href="{{ route('order.payment', ['order' => $order->id]) }}">{{ route('order.payment', ['order' => $order->id]) }}</a>
