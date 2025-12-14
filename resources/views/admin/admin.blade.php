<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laundry Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex min-h-screen text-gray-800">

    <!-- Sidebar -->
    <aside class="bg-gradient-to-b from-blue-900 to-blue-700 w-64 min-h-screen text-white flex flex-col justify-between fixed sm:relative">
        <div>
            <div class="p-6 text-center border-b border-blue-600">
                <h1 class="text-2xl font-extrabold tracking-wide">🧺 Laundry Admin</h1>
            </div>

            <nav class="p-4 space-y-2 mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">🏠 Dashboard</a>
                <a href="{{ route('admin.customers') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.customers') ? 'bg-blue-600' : '' }}">👥 Customers</a>
                 <a href="{{ route('admin.orders') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.orders') ? 'bg-blue-600' : '' }}">📦 Orders</a>
                <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.services.*') ? 'bg-blue-600' : '' }}">🧴 Services</a>
                <a href="{{ route('admin.settings') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.settings') ? 'bg-blue-600' : '' }}">⚙️ Settings</a>
            </nav>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-blue-600">
            @csrf
            <button class="w-full px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white transition">🚪 Logout</button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8 sm:ml-0 sm:mt-16">
        <header class="bg-white p-4 rounded-lg shadow-sm mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold">@yield('page-title')</h2>
            <p class="text-gray-500 text-sm">Welcome, <span class="font-semibold">{{ Auth::user()->name ?? 'Admin' }}</span></p>
        </header>

        <div>
            @yield('content')
        </div>
    </main>
    
@yield('scripts') 

</body>
</html>
