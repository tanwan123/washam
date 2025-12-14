@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-16 px-6">
  <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📦 Request Laundry Pickup</h2>

    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <form id="pickup-form" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700">Pickup Address</label>
        <input type="text" name="pickup_address" required
          class="w-full mt-1 rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Delivery Address (optional)</label>
        <input type="text" name="delivery_address"
          class="w-full mt-1 rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Contact Phone</label>
        <input type="text" name="contact_phone" required
          class="w-full mt-1 rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">
      </div>

      <input type="hidden" name="items" id="items">
      <input type="hidden" name="total" id="total">

      <button type="submit"
        class="w-full bg-orange-600 text-white py-3 rounded-xl font-semibold hover:bg-orange-700 transition">
        Confirm Pickup Request
      </button>
    </form>
  </div>
</section>

<script>
document.getElementById('pickup-form').addEventListener('submit', function(e) {
  e.preventDefault();

  fetch("{{ route('order.store') }}", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      pickup_address: document.querySelector('[name=pickup_address]').value,
      delivery_address: document.querySelector('[name=delivery_address]').value,
      contact_phone: document.querySelector('[name=contact_phone]').value,
      items: JSON.parse(localStorage.getItem('cart_items') || '[]'),
      total: localStorage.getItem('cart_total') || 0
    })
  })
  .then(res => res.json())
  .then(data => {
    if(data.success){
      localStorage.clear();
      window.location.href = "{{ route('orders.my') }}";
    }
  });
});
</script>
@endsection
