<p>
    {{ $order->user->name }}<br />
    {{ $order->user->email }}
</p>

<p>
    Order #{{ $order->id }}
</p>

<table>
    <thead>
        <tr>
            <td>Product</td>
            <td>Unit price</td>
            <td>Quantity</td>
            <td>Total</td>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>
                {{ $item->product->name }}
            </td>
            <td>
                {{ $item->amount }}
            </td>
            <td>
                {{ $item->quantity }}
            </td>
            <td>
                {{ $item->total }}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td><strong>Total</strong></td>
            <td>{{ number_format($order->total / 100, 2) }}</td>
        </tr>
    </tfoot>
</table>
