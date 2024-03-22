<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        #Lo declarado en esta funcion es para poder mostrar el un mensaje personalizado cuando se envia el email
        $this->registerPolicies(); 

        VerifyEmail::toMailUsing(function($notifible,$url){
            return (new MailMessage)
            ->subject('Verificar Cuenta')
            ->line('Tu Cuenta ya esta casi lista, solo debes presionar el enlace a continuacion')
            ->action('Confirmar cuenta',$url)
            ->line('Si no reconoces esta cuenta, puedes ignorar este mensaje');
        }); 
    }
}
