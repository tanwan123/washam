@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6">🛒 Your Laundry Cart</h2>
    
    @if(session('cart') && count(session('cart')) > 0)
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Item</th>
                    <th class="py-2">Quantity</th>
                    <th class="py-2">Price</th>
                    <th class="py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $itemTotal = $item['price'] * $item['quantity']; $total += $itemTotal; @endphp
                    <tr class="border-b">
                        <td class="py-2">{{ $item['name'] }}</td>
                        <td class="py-2">{{ $item['quantity'] }}</td>
                        <td class="py-2">{{ $item['price'] }} FCFA</td>
                        <td class="py-2">{{ $itemTotal }} FCFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-between items-center">
            <span class="font-bold text-xl">Total: {{ $total }} FCFA</span>
            <a href="{{ route('orders.create') }}" class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 transition">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
