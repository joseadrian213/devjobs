<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class MostrarVacantes extends Component
{

    public Vacante $vacante;
    #De esta forma se obtienen valores desde la vista para recuperarlos    
    // #[On('prueba')] 
    // public function prueba($id)
    // {
    //     dd($id); 
    // }
    #[On('eliminarVacante')] 
    public function eliminarVacante(Vacante $vacante)#Estamos obteniendo el objeto completo que le pasamos como parametro desde el script  
    {
        #Eliminamos la vacante 
        $vacante->delete(); 
    }
    use WithPagination; #Con esto podremos utlizar la paginacion sin problemas 
    public function render()
    {

        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10); #Consultamos las vacantes desde livwire para poder mostrarlas 

        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
