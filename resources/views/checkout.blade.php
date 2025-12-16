@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-20 px-6">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-gray-800 mb-6 text-center">Checkout</h2>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-2xl font-bold mb-4">🧾 Your Order Summary</h3>
            <ul id="order-list" class="space-y-2 text-gray-700">
                @foreach(session('cartItems', []) as $item)
                    <li>
                        {{ $item['qty'] }} × {{ $item['name'] }} — 
                        <span class="font-semibold text-green-600">{{ $item['total'] }} FCFA</span>
                    </li>
                @endforeach
            </ul>

            <div class="flex justify-between items-center mt-6 border-t pt-4">
                <p class="text-xl font-bold text-gray-800">Total:</p>
                <p id="total" class="text-2xl font-bold text-green-600">{{ session('total', 0) }} FCFA</p>
            </div>

            <form id="checkout-form" method="POST" action="{{ route('order.store') }}" class="mt-6">
                @csrf
                <input type="hidden" name="items" value="{{ json_encode(session('cartItems', [])) }}">
                <input type="hidden" name="total" value="{{ session('total', 0) }}">
                <div class="flex justify-end">
                    <button type="submit" class="bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection