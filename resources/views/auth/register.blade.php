<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-xl rounded-xl p-8">
            
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                Create an Account
            </h2>

            <form method="POST" action="{{ url('authregister') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input 
                        id="name" 
                        class="block mt-1 w-full" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required 
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
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
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input 
                        id="password_confirmation" 
                        class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" 
                        required 
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <button
                    class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition">
                    Register
                </button>
            </form>

            <!-- Login Link -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:text-indigo-800">
                    Log in
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
