@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-20 px-6">
  <div class="max-w-6xl mx-auto text-center mb-12">
    <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Laundry Services</h2>
    <p class="text-gray-600">
      Choose the type of clothes or items you want to wash and instantly see the prices.
    </p>
  </div>

  <!-- SERVICES -->
  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    @foreach($services as $service)
      <div class="bg-white rounded-2xl shadow-md p-4 service-card">
        <img src="{{ $service->image ?? '/images/default-service.jpeg' }}"
             class="w-full h-48 object-cover rounded-xl mb-4">

        <h3 class="text-xl font-semibold text-gray-800">{{ $service->name }}</h3>

        <p class="text-gray-600 mt-2 mb-4">
          Price:
          <span class="font-bold text-green-600">
            {{ number_format($service->price) }} FCFA
          </span>
        </p>

        <div class="flex justify-between items-center">
          <input type="number"
                 min="0"
                 value="0"
                 class="quantity border rounded-lg w-20 px-2 py-1 text-center"
                 data-price="{{ $service->price }}"
                 data-name="{{ $service->name }}">

          <button class="add-btn bg-green-600 text-white px-4 py-2 rounded-lg">
            Add
          </button>
        </div>
      </div>
    @endforeach
  </div>

  <!-- CART -->
  <div class="max-w-3xl mx-auto mt-16 bg-white rounded-2xl shadow-lg p-6">
    <h3 class="text-2xl font-bold mb-4">🧾 Your Laundry Summary</h3>

    <ul id="cart-list" class="space-y-2"></ul>

    <div class="flex justify-between items-center mt-6 border-t pt-4">
      <span class="text-xl font-bold">Total:</span>
      <span id="total" class="text-2xl font-bold text-green-600">0 FCFA</span>
    </div>

    <div class="mt-6">
      <button id="checkout-btn"
              class="w-full bg-orange-600 text-white py-3 rounded-xl text-lg font-semibold">
        Proceed to Checkout
      </button>
    </div>
  </div>
</section>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

  let cartItems = [];

  const cartList = document.getElementById('cart-list');
  const totalDisplay = document.getElementById('total');

  function renderCart() {
    cartList.innerHTML = '';
    let total = 0;

    cartItems.forEach(item => {
      total += item.total;

      const li = document.createElement('li');
      li.innerHTML = `
        ${item.qty} × ${item.name}
        <span class="float-right font-semibold text-green-600">
          ${item.total} FCFA
        </span>
      `;
      cartList.appendChild(li);
    });

    totalDisplay.textContent = total + ' FCFA';
  }

  document.querySelectorAll('.add-btn').forEach(btn => {
    btn.addEventListener('click', () => {

      const card = btn.closest('.service-card');
      const qtyInput = card.querySelector('.quantity');

      const qty = parseInt(qtyInput.value);
      const price = parseInt(qtyInput.dataset.price);
      const name = qtyInput.dataset.name;

      if (qty <= 0) return;

      const itemTotal = qty * price;

      // Check if item already exists
      const existing = cartItems.find(i => i.name === name);

      if (existing) {
        existing.qty += qty;
        existing.total += itemTotal;
      } else {
        cartItems.push({
          name,
          qty,
          total: itemTotal
        });
      }

      qtyInput.value = 0;
      renderCart();

      Swal.fire({
        icon: 'success',
        title: 'Added!',
        text: `${qty} × ${name} added to your cart.`,
        timer: 1500,
        showConfirmButton: false
      });
    });
  });

  document.getElementById('checkout-btn').addEventListener('click', () => {

    if (cartItems.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Cart is empty',
        text: 'Please add items to your cart before checkout.'
      });
      return;
    }

    const total = cartItems.reduce((sum, i) => sum + i.total, 0);

    Swal.fire({
      icon: 'info',
      title: 'Confirm Checkout',
      text: `Your total is ${total} FCFA. Do you want to proceed?`,
      showCancelButton: true,
      confirmButtonText: 'Yes, proceed'
    }).then(result => {
      if (result.isConfirmed) {

        localStorage.setItem('cart_items', JSON.stringify(cartItems));
        localStorage.setItem('cart_total', total);

        Swal.fire({
          icon: 'success',
          title: 'Checkout Successful',
          text: 'Please provide pickup details to complete your order'
        }).then(() => {
          window.location.href = "{{ route('orders.pickup.form') }}";
        });
      }
    });
  });

});
</script>
@endsection
