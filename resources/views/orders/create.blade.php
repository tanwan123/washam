@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4">Checkout</h2>

    <form id="checkout-form">
        <div class="mb-4">
            <label>Pickup Address</label>
            <input type="text" name="pickup_address" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label>Contact Phone</label>
            <input type="text" name="contact_phone" class="w-full border p-2 rounded" required>
        </div>

        <h3 class="font-semibold mb-2">Items</h3>
        <ul>
            @foreach($cart as $item)
            <li>{{ $item['name'] }} (x{{ $item['quantity'] }}) - ₦{{ number_format($item['price'] * $item['quantity'], 2) }}</li>
            <input type="hidden" name="items[{{ $loop->index }}][service_id]" value="{{ $item['service_id'] }}">
            <input type="hidden" name="items[{{ $loop->index }}][name]" value="{{ $item['name'] }}">
            <input type="hidden" name="items[{{ $loop->index }}][price]" value="{{ $item['price'] }}">
            <input type="hidden" name="items[{{ $loop->index }}][qty]" value="{{ $item['quantity'] }}">
            <input type="hidden" name="items[{{ $loop->index }}][total]" value="{{ $item['price'] * $item['quantity'] }}">
            @endforeach
        </ul>

        <p class="font-bold mt-2">Total: ₦{{ number_format($total, 2) }}</p>

        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded mt-4">Proceed to Checkout</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('checkout-form').addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);

    fetch('{{ route("orders.store") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            alert('Order placed successfully!');
            window.location.href = '/orders'; // redirect to order history
        } else {
            alert('Error: ' + res.message);
        }
    })
    .catch(err => alert('Error submitting order'));
});
</script>
@endsection
