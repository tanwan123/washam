@extends('admin.admin')
@section('page-title','Assign Collector')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-xl font-bold mb-4">Assign Collector for Order #{{ $order->id }}</h3>

    <form action="{{ route('admin.orders.assign', $order->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Select Collector</label>
            <select name="collector_id" class="w-full border rounded p-2">
                <option value="">-- Unassigned --</option>
                @foreach($collectors as $c)
                    <option value="{{ $c->id }}" {{ $order->collector_id == $c->id ? 'selected' : '' }}>
                        {{ $c->name }} ({{ $c->email }})
                    </option>
                @endforeach
            </select>
        </div>
        <button class="bg-orange-600 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('admin.orders') }}" class="ml-2 text-sm text-gray-600">Cancel</a>
    </form>
</div>
@endsection
