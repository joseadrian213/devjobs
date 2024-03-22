<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    #siempre que se genera un middleware se debe de registral en el archivo kernel 
    public function handle(Request $request, Closure $next): Response
    {
        #Un middleware no debe de tener multiples ifs 
        #El middleware se utiliza  para distintas cosas
        if ($request->user()->rol===1) {
            #En caso de que no sea el rol 2, redireccionar al usuario hacia home 
            return redirect()->route('home'); 
        }


        #Una vez finalizado este middleware se ejecuta el  sugiente por eso se llama next 
        return $next($request);
    }
}
