<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-xl rounded-xl p-8">
            
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                Login to Your Account
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ url('authlogin') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button
                    class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition">
                    Log in
                </button>
            </form>

            <!-- Register Link -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:text-indigo-800">
                    Register
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
