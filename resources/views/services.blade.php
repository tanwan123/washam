@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-20 px-6">
  <div class="max-w-6xl mx-auto text-center mb-12">
    <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Laundry Services</h2>
    <p class="text-gray-600">Choose the type of clothes or items you want to wash and instantly see the prices.</p>
  </div>

  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    @foreach($services as $service)
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition p-4 service-card">
      <img src="{{ $service->image ?? '/images/default-service.jpeg' }}"
        alt="{{ $service->name }}"
        class="w-full h-48 object-cover rounded-xl mb-4">
      <h3 class="text-xl font-semibold text-gray-800">{{ $service->name }}</h3>
      <p class="text-gray-600 mt-2 mb-4">Price: <span class="font-bold text-green-600">{{ number_format($service->price, 0) }} FCFA</span></p>

      <div class="flex justify-between items-center">
        <input type="number" min="0" value="0"
          class="quantity border border-gray-300 rounded-lg w-20 px-2 py-1 text-center focus:ring-2 focus:ring-green-400"
          data-price="{{ $service->price }}">
        <button class="add-btn bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Add</button>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Cart Section -->
  <div class="max-w-3xl mx-auto mt-16 bg-white rounded-2xl shadow-lg p-6">
    <h3 class="text-2xl font-bold mb-4 text-gray-800">🧾 Your Laundry Summary</h3>

    <ul id="cart-list" class="space-y-2 text-gray-700"></ul>

    <div class="flex justify-between items-center mt-6 border-t pt-4">
      <p class="text-xl font-bold text-gray-800">Total:</p>
      <p id="total" class="text-2xl font-bold text-green-600">0 FCFA</p>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4">
      <a href="{{ route('services') }}"
        class="w-full bg-gray-800 text-white py-3 rounded-xl text-lg font-semibold hover:bg-gray-900 transition">
        View Cart
      </a>

      <button id="checkout-btn"
        class="w-full bg-orange-600 text-white py-3 rounded-xl text-lg font-semibold hover:bg-orange-700 transition">
        Proceed to Checkout
      </button>


    </div>
  </div>
</section>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const addButtons = document.querySelectorAll('.add-btn');
    const cartList = document.getElementById('cart-list');
    const totalDisplay = document.getElementById('total');
    let total = 0;
    let cartItems = [];

    addButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        const parent = btn.closest('.service-card');

        const itemName = parent.querySelector('h3').textContent;
        const quantityInput = parent.querySelector('.quantity');
        const qty = parseInt(quantityInput.value);
        const price = parseInt(quantityInput.dataset.price);

        if (qty > 0) {
          const itemTotal = qty * price;
          total += itemTotal;

          cartItems.push({
            name: itemName,
            qty: qty,
            total: itemTotal
          });

          const listItem = document.createElement('li');
          listItem.innerHTML = `${qty} × ${itemName} — <span class="font-semibold text-green-600">${itemTotal} FCFA</span>`;
          cartList.appendChild(listItem);
          totalDisplay.textContent = total + ' FCFA';

          quantityInput.value = 0;

          Swal.fire({
            icon: 'success',
            title: 'Added!',
            text: `${qty} × ${itemName} added to your cart.`,
            timer: 1500,
            showConfirmButton: false
          });
        }
      });
    });

    document.getElementById('checkout-btn').addEventListener('click', function() {
      if (cartItems.length === 0) {
        Swal.fire({
          icon: 'warning',
          title: 'Cart is empty',
          text: 'Please add items to your cart before checkout.'
        });
        return;
      }

      Swal.fire({
        icon: 'info',
        title: 'Confirm Checkout',
        text: `Your total is ${total} FCFA. Do you want to proceed?`,
        showCancelButton: true,
        confirmButtonText: 'Yes, proceed'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("{{ route('order.store') }}", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
              },
              body: JSON.stringify({
                items: cartItems,
                total: total
              })
            })
            .then(res => res.json())
            .then(data => {
              Swal.fire({
                icon: 'success',
                title: 'Order Placed!',
                text: 'Your laundry order has been submitted successfully.',
              }).then(() => {
                cartList.innerHTML = '';
                totalDisplay.textContent = '0 FCFA';
                total = 0;
                cartItems = [];
              });
            })
            .catch(err => {
              Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong. Try again later.'
              });
            });
        }
      });
    });

  });
</script>
@endsection