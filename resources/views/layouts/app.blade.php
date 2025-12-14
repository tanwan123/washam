<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laundry Management System</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="font-sans antialiased">
    @include('partial.navbar')


    <div>
        @auth
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button class="px-4 py-2 bg-red-500 rounded-lg">Logout</button>
        </form>
        @else
        <a href="{{ url('/login') }}" class="px-3"></a>
        <a href="{{ url('/register') }}" class="px-3"></a>
        @endauth
    </div>
    </nav>

    <main class="pt-20">
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
        @endif

        @yield('content')

    </main>
    @include('partial._footer')
</body>

</html>