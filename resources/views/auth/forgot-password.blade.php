<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¿Olvadaste tu password? Coloca tu email de registro y enviaremos un enlace para puedas crear uno nuevo.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-between my-5">
            <x-link :href="route('login')">
                {{-- el href se lo estamos pasando como un artibuto  --}}
                Iniciar Sesion
            </x-link>

            <x-link :href="route('register')">
                Crear cuenta
            </x-link>
          
        </div>
         {{--  Las clases que se mandan a llamar en junto con los componente reescriben las que se encuentran dentro del componente  --}}
         <x-primary-button class="w-full justify-center">
            {{ __('Enviar instrucciones') }}
            {{-- Los guiones bajos indican que el texto que se encuentra dentro del helper se puede traducir  --}}
        </x-primary-button>
    </form>
</x-guest-layout>
