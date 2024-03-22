<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $descripcion;
    public $ultimo_dia;
    public $imagen;
    #Para poder subir archivos a livewire debemos de habilitarlo desde de aqui 
    use WithFileUploads;


    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024' #Le indicamos que solo admita imagenes de maximo un mb

    ];
    public function crearVacante()
    {
        #como no tenemos acceso al request creamos por eso la variavle de datos 
        $datos = $this->validate();

        //Almacenar la imagen 

        $imagen = $this->imagen->store('public/vacantes'); #Guardamos la referencia en una variable 
        $datos['imagen'] = str_replace('public/vacantes/', '', $imagen); #Limpiamos las rutas y las remplazamos por nada para asi nada mas obtener elo nombre de la imagen esto es con una funcion de php 
        #estamos reinscribiendo los datos de la imagen 
        //Crear la vacante 
        #Aqui le estamos oasando los datos que enviamos desde el formulario
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id
        ]);
        //Crear un  mensaje
        session()->flash('mensaje','La vacanate se publico correctamente'); 
        //Redireccionar al usuario
        return redirect()->route('vacantes.index'); 

    }
    public function render()
    {
        //Consultar la base de datos 
        $salarios = Salario::all(); #Le indicamos que nos traiga todos los registros de la base de datos  
        $categorias = Categoria::all();
        return view('livewire.crear-vacante', [
            'salarios' => $salarios, #Pasamos la variable hacia la vista 
            'categorias' => $categorias
        ]);
    }
}
