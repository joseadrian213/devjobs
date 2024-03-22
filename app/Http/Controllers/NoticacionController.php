<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    #este controlador tan solo sirve para cceder o invocar en este caso las snotificaciones  y solo conbtiene el invoke 
    public function __invoke(Request $request)
    {
    $notificaciones=auth()->user()->unreadNotifications; #Laravel ya sabe que notificaciones le corresponden a cada usuario gracias a la relacion que creamos de reclutador 
    //Limpiar notificaciones 
    auth()->user()->unreadNotifications->markAsRead(); 
    return view('notificaciones.index',[
        'notificaciones'=>$notificaciones
      ]); 
    }
}
