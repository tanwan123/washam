@extends('layouts.app')

@section('content')
<section class="py-16 px-6">
    <div class="max-w-4xl mx-auto bg-white shadow rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-6">🛒 Your Cart</h2>

        @if(count($cart) > 0)
            <table class="w-full text-left border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Item</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Quantity</th>
                        <th class="border px-4 py-2">Total</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $total = $item['price'] * $item['quantity']; $grandTotal += $total; @endphp
                        <tr>
                            <td class="border px-4 py-2">{{ $item['name'] }}</td>
                            <td class="border px-4 py-2">{{ $item['price'] }} FCFA</td>
                            <td class="border px-4 py-2">{{ $item['quantity'] }}</td>
                            <td class="border px-4 py-2">{{ $total }} FCFA</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('cart.remove', $id) }}" class="text-red-600 hover:underline">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-between items-center mt-6">
                <p class="text-xl font-bold">Grand Total: {{ $grandTotal }} FCFA</p>
                <form method="POST" action="{{ route('checkout') }}">
                    @csrf
                    <input type="hidden" name="pickup_address" value="User Pickup Address">
                    <input type="hidden" name="delivery_address" value="User Delivery Address">
                    <input type="hidden" name="contact_phone" value="{{ Auth::user()->phone ?? '' }}">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                        Proceed to Checkout
                    </button>
                </form>
            </div>

            <form method="POST" action="{{ route('cart.clear') }}" class="mt-4">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                    Clear Cart
                </button>
            </form>
        @else
            <p class="text-gray-600">Your cart is empty.</p>
        @endif
    </div>
</section>
@endsection
