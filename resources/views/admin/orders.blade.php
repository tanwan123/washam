@extends('admin.admin')
@section('page-title','Orders')

@section('content')
<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-xl font-semibold mb-4">All Orders</h3>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-gray-700">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Customer</th>
                    <th class="px-4 py-2">Collector</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $order->id }}</td>
                    <td class="px-4 py-2">{{ $order->user->name }}</td>
                    <td class="px-4 py-2">{{ $order->collector->name ?? 'Unassigned' }}</td>
                    <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                    <td class="px-4 py-2">₦{{ number_format($order->total, 0) }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.orders.assign.form', $order->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded">Assign</a>
                        <a href="{{ route('admin.orders') }}" class="px-3 py-1 bg-gray-200 text-gray-800 rounded">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
