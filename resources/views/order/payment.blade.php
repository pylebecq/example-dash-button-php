@extends('layouts.app')

@section('content')
<div class="">
    <div class="w-1/2 m-auto">
        @if ($error)
        <p class="font-sans text-xl text-red-dark text-center mb-4">There was an error while processing your payment information. Please try again.</p>
        @endif
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('order.payment', ['id' => $order->id]) }}" method="post">
            <p class="font-sans text-xl text-grey-darkest text-center mb-4">New payment details for order #{{ $order->id }}</p>

            @csrf

            <div>
                <label for="cc_number" class="block text-grey-darker text-sm font-bold mb-2">Card number</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text" id="cc_number" name="cc_number" />
            </div>

            <div class="flex flex-wrap mt-4">
                <div class="w-1/2 pr-3">
                    <label for="cc_valid_month" class="block text-grey-darker text-sm font-bold mb-2">Valid until</label>
                    <input class="shadow appearance-none border rounded w-16 py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text" id="cc_valid_month" name="cc_valid_month" placeholder="MM" />
                    <input class="shadow appearance-none border rounded w-32 py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text" id="cc_valid_year" name="cc_valid_year" placeholder="YYYY" />
                </div>

                <div class="w-1/2 pl-3">
                    <label for="cc_cvv" class="block text-grey-darker text-sm font-bold mb-2">CVV</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text" id="cc_cvv" name="cc_cvv" />
                </div>
            </div>

            <div class="mt-6">
                <input class="shadow bg-blue hover:bg-blue-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" />
            </div>
        </form>
    </div>
</div>
@endsection
