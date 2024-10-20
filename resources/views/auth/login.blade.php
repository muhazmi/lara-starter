<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div class="flex items-center">
                <!-- Remember Me -->
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-end space-y-2">
                <x-primary-button class="ms-3">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </div>

    </form>
    <div class="py-3 row">
        @if (Route::has('password.request'))
            <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('password.request') }}">
                {{ __('Lupa Password?') }}
            </a>
        @endif
    </div>

    <div class="text-sm text-gray-600 row dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Belum punya Akun?
        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-800">Daftar disini</a>
    </div>
</x-guest-layout>
