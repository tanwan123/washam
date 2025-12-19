@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-16 px-6">
  <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📦 Request Laundry Pickup</h2>

    <form method="POST" action="{{ route('orders.pickup.form') }}" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700">Pickup Address</label>
        <input type="text" name="pickup_address" required
          class="w-full mt-1 rounded-lg border-gray-300">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">
          Delivery Address (optional)
        </label>
        <input type="text" name="delivery_address"
          class="w-full mt-1 rounded-lg border-gray-300">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Contact Phone</label>
        <input type="text" name="contact_phone" required
          class="w-full mt-1 rounded-lg border-gray-300">
      </div>

      <!-- Hidden fields -->
      <input type="hidden" name="items" id="items">
      <input type="hidden" name="total" id="total">

      <button type="submit"
        class="w-full bg-orange-600 text-white py-3 rounded-xl font-semibold">
        Confirm Pickup Request
      </button>
    </form>
  </div>
</section>

<script>
document.getElementById('pickup-form').addEventListener('submit', function(e) {
  e.preventDefault();

  fetch("{{ route('orders.pickup.store') }}", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      pickup_address: document.querySelector('[name=pickup_address]').value,
      delivery_address: document.querySelector('[name=delivery_address]').value,
      contact_phone: document.querySelector('[name=contact_phone]').value,
      items: JSON.parse(localStorage.getItem('cart_items')),
      total: localStorage.getItem('cart_total')
    })
  })
  .then(res => res.json())
  .then(data => {
    if(data.success){
      localStorage.clear();
      window.location.href = "{{ route('orders.my-requests') }}";
    }
  });
});
</script>

@endsection
