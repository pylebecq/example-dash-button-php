New payment details for order #{{ $order->id }}

<form action="{{ route('order.payment', ['id' => $order->id]) }}" method="post">
    @csrf

    <label for="cc_number">Card number:</label>
    <input type="text" id="cc_number" name="cc_number" />
    <label for="cc_number">CVV:</label>
    <input type="text" id="cc_cvv" name="cc_cvv" placeholder="123" />
    <label for="cc_valid_month">Valid until:</label>
    <input type="text" id="cc_valid_month" name="cc_valid_month" placeholder="MM" /><input type="text" id="cc_valid_year" name="cc_valid_year" placeholder="YYYY" />
    <input type="submit" />
</form>
