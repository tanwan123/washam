@extends('collector.layout')

@section('content')
<h2 class="text-2xl font-bold mb-6">Pickup Requests</h2>

@foreach($orders as $order)
<div class="bg-white shadow rounded p-4 mb-4">
    <p class="font-semibold">Customer: {{ $order->user->name }}</p>

    <ul class="ml-4 list-disc">
        @foreach($order->items as $item)
            <li>{{ $item->quantity }} × {{ $item->service_name }}</li>
        @endforeach
    </ul>

    <span class="text-sm text-orange-600 font-bold">Awaiting Pickup</span>
</div>
@endforeach
@endsection
