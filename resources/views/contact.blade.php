@extends('layouts.app')

@section('content')
<section class="bg-gray-100 py-20">
  <div class="max-w-5xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-gray-800 text-center mb-10">Contact Us</h2>
    <div class="grid md:grid-cols-2 gap-10 items-start">
      <!-- Contact Info -->
      <div>
        <h3 class="text-2xl font-semibold mb-4">Get in Touch</h3>
        <p class="text-gray-600 mb-6">We’re here to help with your laundry needs. Feel free to reach out or drop by our shop anytime.</p>
        <ul class="space-y-3 text-gray-700">
          <li>📍 123 Clean Street, Laundry City</li>
          <li>📞 +1 555 080 201</li>
          <li>✉️ support@washam.com</li>
        </ul>
      </div>

      <!-- Contact Form -->
      <form action="#" method="POST" class="bg-white shadow rounded-2xl p-8 space-y-6">
        <div>
          <label class="block text-gray-700 mb-2">Name</label>
          <input type="text" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
          <label class="block text-gray-700 mb-2">Email</label>
          <input type="email" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
          <label class="block text-gray-700 mb-2">Message</label>
          <textarea class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">Send Message</button>
      </form>
    </div>
  </div>
</section>
@endsection
