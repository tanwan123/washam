@if(auth()->check())

<nav class="bg-white shadow-md rounded-xl mb-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <!-- Logo / Title -->
            <div class="flex items-center gap-3">
                <div class="bg-orange-600 text-white font-bold rounded-lg px-3 py-1">
                    Collector
                </div>
                <span class="text-gray-700 font-semibold">
                    Waste Management System
                </span>
            </div>

            <!-- Links -->
            <div class="flex items-center gap-6">
                <a href="{{ route('collector.dashboard') }}"
                   class="text-gray-700 hover:text-orange-600 font-medium">
                    Dashboard
                </a>

                <a href="{{ route('collector.orders') }}"
                   class="text-gray-700 hover:text-orange-600 font-medium">
                    My Pickups
                </a>

                <a href="{{ route('collector.completed') }}"
                   class="text-gray-700 hover:text-orange-600 font-medium">
                    Completed
                </a>

                <div class="flex items-center gap-3">
                    <span class="text-gray-500 text-sm">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-600 hover:text-red-700 font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</nav>
@endif
