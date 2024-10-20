<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mobile Phone -->
        <div class="mt-4">
            <x-input-label for="mobile_phone" :value="__('Mobile Phone')" />
            <x-text-input id="mobile_phone" class="block w-full mt-1" type="text" name="mobile_phone" :value="old('mobile_phone')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('mobile_phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-4">
            <div class="text-sm text-gray-600 row dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Sudah punya Akun?
                <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-800">Login disini</a>
            </div>
        </div>

    </form>
</x-guest-layout>
