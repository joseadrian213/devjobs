<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center text-gray-900">
                <div class="space-y-3">
                    <a href="{{route('vacantes.show',$vacante->id)}}" class=" text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    {{-- Aqui le estamos dando formato a la fecha  --}}
                    <p>Ultimo dia para Postularse: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>

                </div>
                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a href="{{route('candidatos.index',$vacante)}}"
                        class="text-center bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">{{$vacante->candidatos->count()}} Candidatos</a>
                    <a href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="text-center bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Editar</a>
                    {{-- Con el dispatch emitimos un evento y le anviamos la variable  --}}
                    <button wire:click="$dispatch('mostrarAlerta', {id: {{ $vacante->id }}})"
                        class="text-center bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Eliminar</button>
                </div>
            </div>
        @empty

            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes para mostrar </p>
        @endforelse

    </div>
    <div class=" mt-10">
        {{ $vacantes->links('pagination::tailwind') }}
    </div>
    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            //Esto es una variable superglobal wire
            // Livewire.on('mostrarAlerta',variableId=>{
            //     alert(variableId.id)
            // })
            // El siguiente código es el Alert utilizado
            //De esta forma ponemos a la escuchar a livewire que declaramos en el button y se active el script 
            document.addEventListener('livewire:initialized', () => {
                @this.on('mostrarAlerta', vacanteId => {
                    Swal.fire({
                    title: '¿Eliminar Vacante?',
                    text: "Una vacante eliminada no se puede recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, ¡Eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //De esta froma enviamos un dato a la clase de livewire  y obtengamos el objeto de vacanteId
                        @this.dispatch('eliminarVacante',{vacante: vacanteId})

                        Swal.fire(
                            //Eliminar la vacante desde el servidor 
                            'Vacante Eliminada!',
                            'Su vacante ha sido eliminada correctamente.',
                            'success'
                        )
                    }
                })
                });
            });
         
        </script>
    @endpush
</div>
