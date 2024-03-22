<?php

namespace App\Livewire;

use Livewire\Component;

class MostrarVacante extends Component
{
    #Para que livewire nos reconozca la variable que le pasamos desde el controlador hacia la vista y de la vista hacia liwire debemos declararla aqui tambienh con el mismo nombre 
    public $vacante;
    public function render()
    {

        return view('livewire.mostrar-vacante');
    }
}
