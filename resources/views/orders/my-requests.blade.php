@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-50">
  <div class="max-w-6xl mx-auto px-6">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">
      🧺 My Laundry Requests
    </h2>

    @if($orders->isEmpty())
      <div class="bg-white p-6 rounded-xl shadow text-center text-gray-600">
        You have not made any pickup requests yet.
      </div>
    @else
      <div class="overflow-x-auto bg-white rounded-xl shadow">
        <table class="w-full border-collapse">
          <thead class="bg-green-600 text-white">
            <tr>
              <th class="p-3 text-left">Order #</th>
              <th class="p-3 text-left">Pickup Address</th>
              <th class="p-3 text-left">Phone</th>
              <th class="p-3 text-left">Total</th>
              <th class="p-3 text-left">Status</th>
              <th class="p-3 text-left">Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
              <tr class="border-b hover:bg-gray-50">
                <td class="p-3">#{{ $order->id }}</td>
                <td class="p-3">{{ $order->pickup_address }}</td>
                <td class="p-3">{{ $order->contact_phone }}</td>
                <td class="p-3 font-semibold text-green-600">
                  {{ number_format($order->total, 0) }} FCFA
                </td>
                <td class="p-3">
                  <span class="px-3 py-1 rounded-full text-sm
                    @if($order->status == 'Pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'Assigned') bg-blue-100 text-blue-800
                    @elseif($order->status == 'Completed') bg-green-100 text-green-800
                    @else bg-gray-200 text-gray-700 @endif">
                    {{ $order->status }}
                  </span>
                </td>
                <td class="p-3 text-gray-500">
                  {{ $order->created_at->format('d M Y') }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

  </div>
</section>
@endsection
