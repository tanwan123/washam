@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-50">
  <div class="max-w-6xl mx-auto px-6">

    <h2 class="text-3xl font-bold mb-6">🧺 My Laundry Requests</h2>

    @forelse($orders as $order)
      <div class="bg-white rounded-xl shadow p-5 mb-4">
        <p class="font-bold">Order #{{ $order->id }}</p>
        <p>Total: {{ number_format($order->total) }} FCFA</p>
        <p>Status:
          <span class="font-semibold text-orange-600">
            {{ ucfirst($order->status) }}
          </span>
        </p>
      </div>
    @empty
      <p class="text-gray-500">No orders yet.</p>
    @endforelse

  </div>
</section>
@endsection
