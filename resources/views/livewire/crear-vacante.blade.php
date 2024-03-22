<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        {{-- Con el wire model se encuentra a la escucha back y se conecta con CrearVacante.php se sustituye en name por el wire --}}
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')"
            placeholder="Titulo Vacante" />
        @error('titulo')
            {{-- como le estamos pasando la variable de message a livewire se vuelve dinamico  --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select wire:model="salario" id="salario"
            class=" w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">--Seleccione--</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        @error('salario')
            {{-- como le estamos pasando la variable de message a livewire se vuelve dinamico  --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select wire:model="categoria" id="categoria"
            class=" w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">--Seleccione--</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        @error('categoria')
            {{-- como le estamos pasando la variable de message a livewire se vuelve dinamico  --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')"
            placeholder="Empresa: ej. Netflix, Uber, Shopify" />
        @error('empresa')
            {{-- como le estamos pasando la variable de message a livewire se vuelve dinamico  --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo Dia para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia"
            :value="old('ultimo_dia')" />
        @error('ultimo_dia')
            {{-- como le estamos pasando la variable de message a livewire se vuelve dinamico  --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-input-label for="descripcion" :value="__('Descripcion Puesto')" />
        <textarea wire:model="descripcion" id="descripcion" placeholder="Descripcion general del puesto, experiencia"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring
                 focus:ring-indigo-200 focus:ring-opacity-50 w-full"></textarea>
        @error('descripcion')
            {{-- como le estamos pasando la variable de message a livewire se vuelve dinamico  --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        {{-- Con accept le indicamos que todas las imagenes son recibidas  --}}
        <x-text-input id="imagen" accept="image/*" class="block mt-1 w-full" type="file" wire:model="imagen" />
        {{-- Esto va hacer un preview de la imagen  --}}
        <div class="my-5 w-96">
            @if ($imagen)
                Imagen:
                {{-- Esto almacena unaq imagen temporal y le da una vista previa al usuario de que es lo que desarrollo   --}}
                <img src="{{$imagen->temporaryUrl()}}" alt="">
            @endif
        </div>
        @error('imagen')
            {{-- como le estamos pasando la variable de message a livewire se vuelve dinamico  --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <x-primary-button>
        Crear Vacante
    </x-primary-button>
</form>
