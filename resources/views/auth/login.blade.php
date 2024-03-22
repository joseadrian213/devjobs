<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex justify-between my-5">
            <x-link :href="route('register')">
                {{-- el href se lo estamos pasando como un artibuto  --}}
                Crear cuenta
            </x-link>

            <x-link :href="route('password.request')">
                Olvidaste tu password
            </x-link>
          
        </div>
        {{--  Las clases que se mandan a llamar en junto con los componente reescriben las que se encuentran dentro del componente  --}}
        <x-primary-button class="w-full justify-center">
            {{ __('Iniciar Sesion') }}
            {{-- Los guiones bajos indican que el texto que se encuentra dentro del helper se puede traducir  --}}
        </x-primary-button>
    </form>
</x-guest-layout>
