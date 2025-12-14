@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6">📝 My Orders</h2>

    @if($orders->count())
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Order ID</th>
                    <th class="py-2">Total</th>
                    <th class="py-2">Status</th>
                    <th class="py-2">Pickup Date</th>
                    <th class="py-2">Delivery Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="py-2">{{ $order->id }}</td>
                        <td class="py-2">{{ $order->total }} FCFA</td>
                        <td class="py-2">{{ ucfirst($order->status) }}</td>
                        <td class="py-2">{{ $order->pickup_date ?? '-' }}</td>
                        <td class="py-2">{{ $order->delivery_date ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You have no orders yet.</p>
    @endif
</div>
@endsection
