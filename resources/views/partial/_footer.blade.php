<footer class="bg-gray-900 text-gray-200 mt-16">
  <div class="max-w-6xl mx-auto py-12 px-6 grid md:grid-cols-4 gap-8">
    
    <!-- Company Info -->
    <div>
      <h3 class="text-2xl font-bold text-white mb-4">Washam Laundry</h3>
      <p class="text-gray-400">Fast, reliable, and affordable laundry services. Clean clothes, happy life!</p>
    </div>

    <!-- Quick Links -->
    <div>
      <h4 class="text-xl font-semibold text-white mb-4">Quick Links</h4>
      <ul class="space-y-2">
        <li><a href="{{ route('services') }}" class="hover:text-green-400 transition">Services</a></li>
        <li><a href="{{ route('orders.index') }}" class="hover:text-green-400 transition">My Orders</a></li>
        <li><a href="{{ route('about') }}" class="hover:text-green-400 transition">About Us</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-green-400 transition">Contact</a></li>
      </ul>
    </div>

    <!-- Contact Info -->
    <div>
      <h4 class="text-xl font-semibold text-white mb-4">Contact</h4>
      <p class="flex items-center mb-2">
        <svg class="w-5 h-5 mr-2 text-green-400" fill="currentColor" viewBox="0 0 24 24">
          <path d="M21 8V7l-3 2-2-2 3-2V4l-6-1-1 1-1-1-6 1v1l3 2-2 2-3-2v1l6 1 1-1 1 1 6-1z"/>
        </svg>
        info@washam.com
      </p>
      <p class="flex items-center mb-2">
        <svg class="w-5 h-5 mr-2 text-green-400" fill="currentColor" viewBox="0 0 24 24">
          <path d="M3 5v14h18V5H3zm16 12H5V7h14v10zM8 9h8v2H8V9zm0 4h5v2H8v-2z"/>
        </svg>
        +237 652881815
      </p>
      <p class="flex items-center">
        <svg class="w-5 h-5 mr-2 text-green-400" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z"/>
        </svg>
        Douala, Cameroon
      </p>
    </div>

    <!-- Social Media -->
    <div>
      <h4 class="text-xl font-semibold text-white mb-4">Follow Us</h4>
      <div class="flex space-x-4">
        <a href="#" class="hover:text-green-400 transition"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="hover:text-green-400 transition"><i class="fab fa-twitter"></i></a>
        <a href="#" class="hover:text-green-400 transition"><i class="fab fa-instagram"></i></a>
        <a href="#" class="hover:text-green-400 transition"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>

  </div>

  <div class="border-t border-gray-800 mt-8 py-4 text-center text-gray-500 text-sm">
    &copy; {{ date('Y') }} Washam Laundry. All rights reserved.
  </div>
</footer>

<!-- FontAwesome for social icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
