@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-20">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
    <div>
      <h2 class="text-4xl font-bold text-gray-800 mb-4">About Us</h2>
      <p class="text-gray-600 mb-6 leading-relaxed">
        We’re dedicated to making laundry stress-free for everyone. From everyday washing to premium dry-cleaning, we deliver professional service with care and precision. Our goal is to make your clothes look and feel new again!
      </p>
      <ul class="space-y-3 text-gray-700">
        <li>✔ Over 10 years of laundry experience</li>
        <li>✔ Eco-friendly washing process</li>
        <li>✔ Free pickup and delivery</li>
      </ul>
      <a href="{{ url('/services') }}" class="mt-8 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        View Our Services
      </a>
    </div>

    <div class="flex justify-center">
      <img src="{{ asset('images/laundry-team.jpg') }}" alt="Laundry Team" class="rounded-2xl shadow-lg w-full max-w-md">
    </div>
  </div>
</section>
@endsection
