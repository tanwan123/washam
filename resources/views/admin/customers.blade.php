@extends('admin.admin')

@section('page-title', 'Customers')

@section('content')
<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-xl font-semibold mb-4">Registered Customers</h3>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-gray-700">
            <thead class="border-b bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Joined</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr class="border-b hover:bg-gray-50">
                    <td class="flex items-center gap-2 px-4 py-2">
                        <div class="bg-blue-100 text-blue-700 font-bold w-8 h-8 flex items-center justify-center rounded-full">
                            {{ strtoupper(substr($customer?->name, 0, 1)) }}
                        </div>
                        {{ $customer->name }}
                    </td>
                    <td class="px-4 py-2">{{ $customer->email }}</td>
                    <td class="px-4 py-2 text-sm text-gray-500">{{ $customer->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
