<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collector Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-md rounded-xl mb-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div class="bg-orange-600 text-white font-bold rounded-lg px-3 py-1">Collector</div>
                    <span class="text-gray-700 font-semibold">Waste Management System</span>
                </div>
                <div class="flex items-center gap-6">
                    <a href="{{ url('/collector/dashboard') }}" class="text-gray-700 hover:text-orange-600 font-medium">Dashboard</a>
                    <a href="{{ url('/collector/orders') }}" class="text-gray-700 hover:text-orange-600 font-medium">My Pickups</a>
                    <a href="{{ url('/collector/completed') }}" class="text-gray-700 hover:text-orange-600 font-medium">Completed</a>
                    <div class="flex items-center gap-3">
                        <span class="text-gray-500 text-sm">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-red-600 hover:text-red-700 font-medium">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-gray-500">Assigned Orders</p>
                <h3 class="text-4xl font-bold text-orange-600 mt-2">{{ $assignedOrders->count() }}</h3>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-gray-500">Picked Up</p>
                <h3 class="text-4xl font-bold text-blue-600 mt-2">{{ $pickedOrders->count() }}</h3>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-gray-500">Delivered</p>
                <h3 class="text-4xl font-bold text-green-600 mt-2">{{ $deliveredOrders->count() }}</h3>
            </div>
        </div>

        <!-- Assigned Orders Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Assigned Orders</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="p-4">Order #</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Pickup Address</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($assignedOrders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 font-semibold">#{{ $order->id }}</td>
                                <td class="p-4">{{ $order->user->name }}</td>
                                <td class="p-4">{{ $order->pickup_address }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($order->status === 'Pending') bg-yellow-100 text-yellow-700
                                        @elseif($order->status === 'Picked Up') bg-blue-100 text-blue-700
                                        @elseif($order->status === 'Delivered') bg-green-100 text-green-700
                                        @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($order->status === 'Pending')
                                        <form method="POST" action="{{ route('collector.order.pickup', $order->id) }}">
                                            @csrf
                                            <button class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg">Pick Up</button>
                                        </form>
                                    @elseif($order->status === 'Picked Up')
                                        <form method="POST" action="{{ route('collector.order.deliver', $order->id) }}">
                                            @csrf
                                            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Deliver</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500">No orders assigned yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>