<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Roles de usuario -->
        <div class="mt-4">
            <x-input-label for="for" :value="__('¿Que tipo de Cuenta deseas en DevJobs?')" />
            <select name="rol" id="rol" class=" w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
                <option value="">-- Selecciona un rol --</option>
                <option value="1"> Developer - Obtener Empleos </option>
                <option value="2"> Recruiter - Publicar Empleos </option>

            
            </select>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-between my-5">
            <x-link :href="route('login')">
                {{-- el href se lo estamos pasando como un artibuto  --}}
                Iniciar Sesion
            </x-link>

            <x-link :href="route('password.request')">
                Olvidaste tu password
            </x-link>

        </div>
        {{--  Las clases que se mandan a llamar en junto con los componente reescriben las que se encuentran dentro del componente  --}}
        <x-primary-button class="w-full justify-center">
            {{ __('Crear Cuenta') }}
            {{-- Los guiones bajos indican que el texto que se encuentra dentro del helper se puede traducir  --}}
        </x-primary-button>
    </form>
</x-guest-layout>
