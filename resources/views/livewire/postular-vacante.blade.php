<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>
    @if (session()->has('mensaje'))
        <div
            class="rounded-lg uppercase border border-green-600 bg-green-100 text-green-600  font-bold p-2 my-5 text-sm">
            {{ session('mensaje') }}
        </div>
    @elseif (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <p class="font-bold">Opps!</p>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @else
        <form wire:submit.prevent='postularme' class="w-96 mt-5">
            <div class="mb-4">
                <x-input-label for="cv" :value="__('Curriculum o Hoja de Vida (PDF)')" />
                <x-text-input id="cv" wire:model="cv" type="file" accept=".pdf" />
            </div>
            @error('cv')
                <livewire:mostrar-alerta :message="$message">
                @enderror
                <x-primary-button class="my-5">
                    {{ __('Postularme') }}
                </x-primary-button>
        </form>
    @endif
</div>
