@extends('layouts.app')

@section('content')
<!-- Hero Section: Full-Color Responsive Background -->
<section class="relative pt-24 pb-32 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center" 
         style="background-image: url('{{ asset('images/laundry_background_pattern.svg') }}');">
    </div>

    <!-- Content Wrapper -->
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center flex flex-col items-center">
        <!-- Hero Text -->
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-black mb-4 leading-tight drop-shadow-lg">
            Clean Clothes, Effortless Living
        </h1>
        <p class="text-lg sm:text-xl text-black mb-10 max-w-2xl mx-auto drop-shadow-md">
            Schedule pickup and delivery in minutes. Experience faster, smarter, and more reliable laundry service.
        </p>

        <!-- Hero Images -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8 w-full max-w-4xl">
            <img src="{{ asset('images/clothes.jpg') }}" alt="Clothes" class="w-full rounded-2xl shadow-lg">
            <img src="{{ asset('images/washingclothes.jpg') }}" alt="Washing" class="w-full rounded-2xl shadow-lg">
            <img src="{{ asset('images/finalimage3.jpg') }}" alt="Folded Laundry" class="w-full rounded-2xl shadow-lg">
        </div>

        <!-- Book Pickup Button -->
        <a href="{{ route('order.create') }}" 
           class="mt-4 inline-block bg-orange-600 text-white font-bold text-lg px-10 py-4 rounded-xl shadow-lg hover:bg-orange-700 transition transform hover:scale-105">
            Book Pickup
        </a>
    </div>
</section>


    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="text-center mb-16">
            <span class="text-orange-600 font-semibold uppercase tracking-wider">Our Promise</span>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-2">Services You Will Love</h2>
            <p class="text-gray-600 mt-3">We handle the details so you don't have to.</p>
        </div>
        
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8">
            
            <!-- Service Card 1 -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition duration-300 text-center">
                <div class="text-4xl text-orange-500 mb-4 mx-auto w-12 h-12 flex items-center justify-center rounded-full bg-orange-50">🧺</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Quality Guarantee</h3>
                <p class="text-gray-600">We treat every garment with care. If you're not satisfied, we'll re-wash it for free.</p>
            </div>
            
            <!-- Service Card 2 -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition duration-300 text-center">
                <div class="text-4xl text-orange-500 mb-4 mx-auto w-12 h-12 flex items-center justify-center rounded-full bg-orange-50">💸</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Transparent & Affordable Pricing</h3>
                <p class="text-gray-600">No hidden fees or surprises. See exactly what you pay for before you order.</p>
            </div>
            
            <!-- Service Card 3 -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition duration-300 text-center">
                <div class="text-4xl text-orange-500 mb-4 mx-auto w-12 h-12 flex items-center justify-center rounded-full bg-orange-50">🚚</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Free Pickup & Delivery</h3>
                <p class="text-gray-600">Schedule at your convenience. We collect and deliver your clean clothes right to your door.</p>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="bg-orange-50 py-20">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
            
            <!-- Text & Features -->
            <div>
                <span class="text-orange-600 font-semibold uppercase tracking-wider">The Smart Choice</span>
                <h2 class="text-4xl font-extrabold text-gray-900 mb-6 mt-2">Why Customers Choose Us</h2>
                <p class="text-gray-700 mb-8 leading-relaxed">
                    We combine professional quality care with cutting-edge convenience. Our entire process is optimized for speed, reliability, and maximum satisfaction.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 text-orange-600 mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-900">Lightning-Fast Turnaround</h4>
                            <p class="text-gray-600">Guaranteed completion within 24-48 hours.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 text-orange-600 mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2zM21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.805A12.017 12.017 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-900">Real-Time Tracking</h4>
                            <p class="text-gray-600">Monitor your order status from pickup to drop-off via our app.</p>
                        </div>
                    </div>
                </div>
                
                <a href="#pricing" class="inline-block mt-10 bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:bg-orange-700 transition duration-300">
                    See Pricing Plans
                </a>
            </div>

            <!-- Image -->
            <div class="flex justify-center order-first lg:order-last">
                <img src="{{ asset('images/hanger_of_clothes_modern.png') }}" 
                     alt="Clothes neatly on a hanger" 
                     class="w-full max-w-md rounded-2xl shadow-2xl transition duration-500 hover:shadow-orange-500/50"
                     onerror="this.onerror=null;this.src='https://placehold.co/600x400/f97316/ffffff?text=Quality+Care';"
                >
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 text-center">
        <span class="text-orange-600 font-semibold uppercase tracking-wider">Value for Money</span>
        <h2 class="text-4xl font-extrabold text-gray-900 mt-2 mb-14">Simple & Fair Pricing</h2>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto px-6">
            <!-- Card 1: Basic -->
            <div class="p-10 rounded-3xl bg-white shadow-xl border border-gray-100 transform hover:scale-[1.02] transition duration-300">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Basic Wash</h3>
                <p class="text-gray-500 mb-4">Standard Wash & Fold</p>
                <div class="flex justify-center items-end mb-6">
                    <span class="text-4xl font-extrabold text-orange-600">$12</span>
                    <span class="text-gray-500">/ Bag</span>
                </div>
                <a href="{{ route('order.create') }}?plan=basic" class="block w-full bg-orange-100 text-orange-700 font-semibold py-3 rounded-lg hover:bg-orange-200 transition">
                    Select Basic
                </a>
            </div>

            <!-- Card 2: Premium -->
            <div class="p-10 rounded-3xl bg-orange-700 shadow-2xl shadow-orange-500/50 border-4 border-orange-400 transform scale-[1.05]">
                <span class="bg-white text-orange-700 text-xs font-bold uppercase px-3 py-1 rounded-full absolute -top-4 right-1/2 translate-x-1/2">Most Popular</span>
                <h3 class="text-3xl font-bold text-white mb-2">Premium Care</h3>
                <p class="text-orange-200 mb-4">Includes Dry Cleaning</p>
                <div class="flex justify-center items-end mb-6">
                    <span class="text-5xl font-extrabold text-white">$37</span>
                    <span class="text-orange-200">/ Month</span>
                </div>
                <a href="{{ route('order.create') }}?plan=regular" class="block w-full bg-white text-orange-700 font-extrabold py-4 rounded-lg hover:bg-orange-100 transition shadow-lg">
                    Go Premium
                </a>
            </div>

            <!-- Card 3: VIP -->
            <div class="p-10 rounded-3xl bg-white shadow-xl border border-gray-100 transform hover:scale-[1.02] transition duration-300">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">VIP Package</h3>
                <p class="text-gray-500 mb-4">All-inclusive Family Option</p>
                <div class="flex justify-center items-end mb-6">
                    <span class="text-4xl font-extrabold text-orange-600">$78</span>
                    <span class="text-gray-500">/ Month</span>
                </div>
                <a href="{{ route('order.create') }}?plan=mega" class="block w-full bg-orange-100 text-orange-700 font-semibold py-3 rounded-lg hover:bg-orange-200 transition">
                    Select VIP
                </a>
            </div>
        </div>
    </section>

</div>

@endsection
