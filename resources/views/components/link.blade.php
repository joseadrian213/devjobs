<div>
    @php
        $classes=" text-xs text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500";
    @endphp
    {{-- Le estamos pasando los atributos que en este caso seria el href para poder clarar mas atribusto tenemos que poasarselos con el merge aqui es lo equivalente a que si escribieramos class="Estilos" --}}
    <a {{$attributes->merge(['class'=>$classes])}}>
        {{ $slot }}
    </a>
</div>