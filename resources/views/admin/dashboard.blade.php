@extends('admin.admin')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🧺 Laundry Admin Dashboard</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                Logout
            </button>
        </form>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- Users -->
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-2">👥 Manage Users</h2>
            <p class="text-gray-600 mb-4">View and manage all registered users.</p>
            <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-lg">View Users</a>
        </div>

        <!-- Orders -->
         
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-2">🧺 Laundry Orders</h2>
            <p class="text-gray-600 mb-4">Track and manage laundry service requests.</p>
            <a href="#" class="bg-green-500 text-white px-4 py-2 rounded-lg">View Orders</a>
        </div>

        <!-- Payments -->
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-2">💰 Payments</h2>
            <p class="text-gray-600 mb-4">View and manage all payment transactions.</p>
            <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">View Payments</a>
        </div>
    </div>
</div>
@endsection
