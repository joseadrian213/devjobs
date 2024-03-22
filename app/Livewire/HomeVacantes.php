<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
class HomeVacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;
    use WithPagination;
    #De esta foirma estamos pasandole los datos al padre desde el hijo que es filtrar vacantes 
    #[On('terminosBusqueda')]
    public function buscar($termino, $categoria, $salario)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
    }
    public function render()
    {
    //     $vacantes=Vacante::all(); 
        #Este when solo se va ejecutar si los valores contienen algo los que definicos arriba 



        
           
           $vacantes = Vacante::where(function ($query) {
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%")
            // La busqueda se encuentra entre dos % % para que no importe si esta al principio o al final 
            ->orWhere('empresa', 'LIKE', "%" . $this->termino . "%");
            })->when($this->categoria, function ($query) {
                $query->where('categoria_id', $this->categoria);
            })->when($this->salario, function ($query) {
                $query->where('salario_id', $this->salario);
            })->orderBy('created_at', 'DESC')->paginate(20);
     
            return view('livewire.home-vacantes', [
                'vacantes' => $vacantes
            ]);

    }
}
