<nav class="bg-white border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <!-- replace with your logo image or inline SVG -->
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-auto">
        <span class="font-bold text-lg text-gray-800">Washam</span>
      </a>

      <div class="hidden sm:flex space-x-6 items-center">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-white-600' : 'text-white-700' }}">Home</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-white-600' : 'text-gray-700' }}">About</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-white-600' : 'text-gray-700' }}">Contact</a>
        <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'text-white-600' : 'text-gray-700' }}">Services</a>
      </div>

      <div class="hidden sm:flex items-center space-x-4">
        @auth
          <div class="relative">
            <button id="user-btn" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 bg-white hover:text-gray-800">
              {{ Auth::user()->name }}
              <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"/></svg>
            </button>

            <!-- simple dropdown -->
            <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded shadow">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
              </form>
            </div>
          </div>
        @else
          <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600">Login</a>
          <a href="{{ route('register') }}" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Register</a>
        @endauth
      </div>

      <div class="sm:hidden">
        <button id="mobile-toggle" class="p-2 rounded-md text-gray-500 hover:bg-gray-200">
          <!-- hamburger icon -->
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
  </div>

  <!-- mobile menu -->
  <div id="mobile-menu" class="hidden sm:hidden bg-white border-t border-gray-200">
    <a href="{{ route('home') }}" class="block px-4 py-2">Home</a>
    <a href="{{ route('about') }}" class="block px-4 py-2">About</a>
    <a href="{{ route('contact') }}" class="block px-4 py-2">Contact</a>
    <a href="{{ route('services') }}" class="block px-4 py-2">Services</a>
    @guest
      <a href="{{ route('login') }}" class="block px-4 py-2">Login</a>
      <a href="{{ route('register') }}" class="block px-4 py-2">Register</a>
    @endguest
    @auth
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-2">Logout</button>
      </form>
    @endauth
  </div>

  <script>
    // small JS to toggle menus
    document.getElementById('mobile-toggle').addEventListener('click', () => {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });
    const userBtn = document.getElementById('user-btn');
    if (userBtn) {
      userBtn.addEventListener('click', () => {
        document.getElementById('user-menu').classList.toggle('hidden');
      });
    }
  </script>
</nav>
