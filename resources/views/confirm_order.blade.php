@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow-md p-6 rounded">
    <h2 class="text-2xl font-bold text-center mb-4 text-orange-600">Confirm Your Order</h2>

    <div class="mb-4">
        <h3 class="font-semibold">Service:</h3>
        <p>{{ $service->name }}</p>
    </div>

    <div class="mb-4">
        <h3 class="font-semibold">Price:</h3>
        <p>{{ $service->price }} FCFA</p>
    </div>

    <div class="mb-4">
        <h3 class="font-semibold">Description:</h3>
        <p>{{ $service->description }}</p>
    </div>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <input type="hidden" name="service_id" value="{{ $service->id }}">

        <button 
            type="submit"
            class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 rounded">
            Confirm Order
        </button>
    </form>
</div>
@endsection
