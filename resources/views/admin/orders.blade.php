@extends('admin.admin')

@section('content')
<h2 class="text-2xl font-bold mb-6">Customer Orders</h2>

<div class="bg-white rounded shadow overflow-x-auto">
<table class="w-full">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Customer</th>
            <th class="p-3 text-left">Items</th>
            <th class="p-3 text-left">Total</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Collector</th>
            <th class="p-3 text-left">Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($orders as $order)
        <tr class="border-t">
            <!-- Customer -->
            <td class="p-3">
                {{ $order->customer?->name ?? 'Unknown customer' }}
            </td>

            <!-- Items -->
            <td class="p-3">
                {{ $order->items->count() }}
            </td>

            <!-- Total -->
            <td class="p-3">
                {{ number_format($order->total) }} FCFA
            </td>

            <!-- Status -->
            <td class="p-3 font-semibold capitalize">
                {{ str_replace('_',' ', $order->status) }}
            </td>

            <!-- Collector -->
            <td class="p-3">
                {{ $order->collector?->name ?? 'Not assigned' }}
            </td>

            <!-- Action -->
            <td class="p-3">
                @if($order->status === 'pending')
                <form method="POST" action="{{ route('admin.orders.assign', $order->id) }}" class="flex gap-2">
                    @csrf

                    <select name="collector_id" required class="border rounded px-2 py-1">
                        <option value="">Select Collector</option>
                        @foreach(\App\Models\User::where('role','collector')->get() as $collector)
                            <option value="{{ $collector->id }}">
                                {{ $collector->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700">
                        Assign
                    </button>
                </form>
                @else
                    —
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-6 text-center text-gray-500">
                No orders have been placed yet
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
