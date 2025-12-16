@extends('admin.admin')

@section('page-title', 'Customer Orders')

@section('content')
<h2 class="text-3xl font-bold mb-6">New Laundry Orders</h2>

@foreach($orders as $order)
<div class="bg-white rounded-lg shadow p-5 mb-4">
    <p class="font-bold">Customer: {{ $order->user->name }}</p>
    <p>Status: 
        <span class="text-orange-600 font-semibold">
            {{ ucfirst($order->status) }}
        </span>
    </p>
    <p>Total: {{ $order->total }} FCFA</p>

    <ul class="ml-5 mt-2 list-disc">
        @foreach($order->items as $item)
            <li>{{ $item->quantity }} × {{ $item->service_name }}</li>
        @endforeach
    </ul>
</div>
@endforeach
@endsection
