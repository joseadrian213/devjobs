<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3">{{ $vacante->titulo }}</h3>
        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10">
            <p class="font-bold text-sm text-gray-800 my-3">Empresa:
                <span class="normal-case font-normal">{{ $vacante->empresa }}</span>
            </p>
            <p class="font-bold text-sm text-gray-800 my-3">Ultimo dia para postularse:
                {{-- Formateamos la fecha para que se muestre de otra manera  --}}
                <span class="normal-case font-normal">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span>
            </p>
            <p class="font-bold text-sm text-gray-800 my-3">Categoria:
                {{-- Debido a que en vacante solo tenemo el id debemos realizar una relacion en el modelo y una vez creada la relacion podemos  
                    mandar a llamar el nombre primero accediento a vacante y despues al metodo que realizamos y por utlimos al titulo que se encuentra en la columna categoria   --}}
                <span class="normal-case font-normal">{{ $vacante->categoria->categoria }}</span>
            </p>
            <p class="font-bold text-sm text-gray-800 my-3">Salario:

                <span class="normal-case font-normal">{{ $vacante->salario->salario }}</span>
            </p>
        </div>
    </div>
    <div class="md:grid md:grid-cols-6 gap-4">
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}"
                alt="{{ 'imagen vacante ' . $vacante->titulo }}">
        </div>
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripcion del Puesto</h2>
            <p>{{ $vacante->descripcion }}</p>
        </div>
    </div>
    @guest

        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>
                ¿Deseas aplicar a esta vacante? <a class="font-bold text-indigo-600 " href="{{ route('register') }}"> Obten
                    una cuenta y aplica a esta y otras vacantes :)</a>
            </p>
        </div>
    @endguest
    {{-- 
        {{-- Con el can restringimos que cosas son las que puede ver cada usuario pasandole la ruta completa 
         @can('create', App\Models\Vacante::class)
         {{-- Le pasamos la ruta completa para que solo en este caso el reclutador lo pueda ver 
             <p>Eres un reclutador </p>
             @else
             {{-- Se le mostrara unicamente a los devs  -
             <livewire:postular-vacante />         
         @endcan
         --}}
    {{-- Lo que pasamos dentro de la directiva es el policy que creamos aqui igualmente estamos aplicando la condicion del metodo create que si el usuario contiene el rol 2  --}}
    {{-- Otra forma de realizar lo mismo en este caso es con cannot --}}
    @cannot('create', App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante"/>
    @endcannot
</div>
