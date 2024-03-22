<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Pasamos el metodo que creamos con el policy para solo permitir a ciertos usuarios ver este apartado
       $this->authorize('viewAny',Vacante::class); #En este caso como el policy no requiere nada le debemos de pasar el modelo 
        return view('vacantes.index'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Vacante::class);
        return view('vacantes.create'); 
    }


    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show',[
            'vacante'=>$vacante
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {
        //
        #Para poder dar acceso al editar vacante el usuario deb ser el mismo que la creo 
        #La validacion si el usuario es el mismo que creo la vacante la realizamos con el policy
        #con el policy damos acceso 
        #Le tenemos que enviar al policy los parametros que va evaluar  
        $this->authorize('update',$vacante); 
        return view('vacantes.edit',[
             'vacante'=>$vacante #Aqui le podemos pasar el modelo de vacatne gracias route model binding que permiter psarle directamente el modelo 
        ]);
    }

 
}