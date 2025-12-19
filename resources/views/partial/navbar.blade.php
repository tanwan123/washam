<!-- resources/views/layouts/header.blade.php -->

<nav class="bg-white shadow-md border-b border-gray-200 fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
                <span class="font-bold text-xl text-gray-800 group-hover:text-orange-600">
               WASHAM
                </span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex space-x-8 items-center">

                <a href="{{ url('/') }}"
                   class="{{ request()->is('/') ? 'text-orange-600 font-semibold border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600 hover:border-b-2 hover:border-orange-600' }} transition duration-200 pb-1">
                    Home
                </a>



                <a href="{{ url('/services') }}"
                   class="{{ request()->is('services') ? 'text-orange-600 font-semibold border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600 hover:border-b-2 hover:border-orange-600' }} transition duration-200 pb-1">
                   Services
                </a>

                @auth
                <a href="{{ route('orders.pickup.form') }}" 
                   class="{{ request()->is('request-pickup') ? 'text-orange-600 font-semibold border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600 hover:border-b-2 hover:border-orange-600' }} transition duration-200 pb-1">
                    Request Pickup
                </a>

                <a href="{{ route('orders.my-requests') }}" 
                   class="{{ request()->is('my-requests') ? 'text-orange-600 font-semibold border-b-2 border-orange-600' : 'text-gray-700 hover:text-orange-600 hover:border-b-2 hover:border-orange-600' }} transition duration-200 pb-1">
                    My Requests
                </a>

                <!-- Notifications -->
                <div class="relative">
                    @php
                        try {
                            $unreadCount = Auth::user()->unreadNotifications()->count();
                        } catch (\Exception $e) {
                            $unreadCount = 0;
                        }
                    @endphp

                    <button class="relative">
                        <span class="material-icons text-2xl text-gray-700 hover:text-orange-600">
                            notifications
                        </span>

                        @if($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full text-xs px-1">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </button>
                </div>
                @endauth

            </div>

            <!-- Auth Buttons / Profile -->
            <div class="hidden sm:flex items-center space-x-4">
                @guest
                    <a href="{{ url('/login') }}" class="text-gray-700 hover:text-orange-600 transition">
                        Login
                    </a>
                    <a href="{{ url('/register') }}"
                       class="px-4 py-2 bg-orange-600 text-white rounded-lg shadow hover:bg-orange-700 transition">
                        Sign Up
                    </a>
                @endguest

                @auth
                    <div class="relative">
                        <button id="user-btn" 
                                class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-700 bg-gray-100 hover:text-orange-600 hover:bg-gray-200 transition">
                            {{ Auth::user()->name }}
                            <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 
                                4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"/>
                            </svg>
                        </button>

                        <div id="user-menu" 
                             class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg border rounded-lg overflow-hidden">
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 transition">
                                Profile
                            </a>
                            <!-- POST logout to redirect to login -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Icon -->
            <div class="sm:hidden">
                <button id="mobile-toggle" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-white border-t border-gray-200 shadow-md">
        <a href="{{ url('/') }}" class="block px-4 py-2 hover:bg-orange-50 transition">Home</a>
        <a href="{{ url('/about') }}" class="block px-4 py-2 hover:bg-orange-50 transition">About</a>
        <a href="{{ url('/how-it-works') }}" class="block px-4 py-2 hover:bg-orange-50 transition">How it Works</a>
        <a href="{{ url('/contact') }}" class="block px-4 py-2 hover:bg-orange-50 transition">Contact</a>

        @auth
            <a href="{{ url('/request-pickup') }}" class="block px-4 py-2 hover:bg-orange-50 transition">Request Pickup</a>
            <a href="{{ url('/my-requests') }}" class="block px-4 py-2 hover:bg-orange-50 transition">My Requests</a>
        @endauth

        @guest
            <a href="{{ url('/login') }}" class="block px-4 py-2 hover:bg-orange-50 transition">Login</a>
            <a href="{{ url('/register') }}" class="block px-4 py-2 bg-orange-600 text-white rounded-lg mx-4 my-2 text-center hover:bg-orange-700 transition">
                Sign Up
            </a>
        @endguest

        @auth
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-orange-50 transition">Logout</button>
            </form>
        @endauth
    </div>
</nav>

<script>
document.getElementById('mobile-toggle')?.addEventListener('click', () => {
    document.getElementById('mobile-menu')?.classList.toggle('hidden');
});

document.getElementById('user-btn')?.addEventListener('click', () => {
    document.getElementById('user-menu')?.classList.toggle('hidden');
});
</script>
