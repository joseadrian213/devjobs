<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{
    public $vacante_id;
    #se deben de declarar los atributos que se pasan a traves de la vista por el wire 
    public $titulo;
    #Nos debemos de guiar por lo que esta en la tabla de la base de vacante 
    #En este caso estamos utilizando el salario_id en la base 
    public $salario;
    public $categoria;
    public $empresa;
    #Como la fecha la estamos mostrando en otro formato debemos formatearla de nuevo para mostrarla 
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;
    use WithFileUploads;

    #definimos las validaciones 
    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024' #Con el nullable le decimos que en caso de que contenga un valor le haga validaciones 
    ];
    #Esto es un ciclo de vida 
    #Se le debe de indicar que modelo es el que le esta pasando la variable que es lo que le estamos pasando desde la viosta pero esto es para que reconozca la variable  
    public function mount(Vacante $vacante)
    {
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }
    #Esta funcion se ejecuta con el formulario 
    public function editarVacante()
    {
        $datos = $this->validate();

        //Si hay una nueva umagen 
        if ($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store('public/vacantes'); #Guardamos la referencia 
            $datos['imagen'] = str_replace('public/vacantes', '', $imagen); #Obtenemos el nombre de la imagen 
        }
        //Encontrar la vacante a editar 
        $vacante = Vacante::find($this->vacante_id);

        //Asignar los valores 
        $vacante->titulo = $datos['titulo']; #primero se le pasa el valor de la base dea tos despues el de la instancia 
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen; #Si hay una nueva imagen se guarda la nueva imagen y si no  volvemos a guardar la misma  
        //Guardar la vacante
        $vacante->save();
        //Redireccionar 
        session()->flash('mensaje', 'La Vacante se actualizo Correctamente');  #Enviamos el mensaje de que se redirecciono correctamente 
        return redirect()->route('vacantes.index');
    }
    public function render()
    {
        $salarios = Salario::all(); #Le indicamos que nos traiga todos los registros de la base de datos  
        $categorias = Categoria::all();
        return view('livewire.editar-vacante', [
            'salarios' => $salarios, #Pasamos la variable hacia la vista 
            'categorias' => $categorias
        ]);
    }
}
