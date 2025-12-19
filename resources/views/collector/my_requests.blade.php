@extends('collector.layout')

@section('content')
<h2 class="text-2xl font-bold mb-6">My Assigned Orders</h2>

@foreach($orders as $order)
<div class="bg-white p-4 mb-4 rounded shadow">
    <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

    @if($order->status === 'assigned')
        <form method="POST" action="{{ route('collector.pickup', $order) }}">
            @csrf
            <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">
                Mark Picked Up
            </button>
        </form>
    @elseif($order->status === 'picked_up')
        <form method="POST" action="{{ route('collector.complete', $order) }}">
            @csrf
            <button class="mt-2 bg-green-600 text-white px-4 py-2 rounded">
                Mark Completed
            </button>
        </form>
    @endif
</div>
@endforeach
@endsection
