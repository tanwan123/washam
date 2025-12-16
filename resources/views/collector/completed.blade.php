<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Completed Orders</title>
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
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="p-4">Order #</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Delivery Address</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($completedOrders as $order)
                            <tr>
                                <td class="p-4 font-semibold">#{{ $order->id }}</td>
                                <td class="p-4">{{ $order->user->name }}</td>
                                <td class="p-4">{{ $order->delivery_address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>