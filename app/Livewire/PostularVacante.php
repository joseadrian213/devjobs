<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];
    public function mount(Vacante $vacante)
    {
        $this->$vacante = $vacante;
    }
    public function postularme()
    {
        $datos = $this->validate();

        // validar que el usuario no haya postulado a la vacante
        if ($this->vacante->candidatos()->where('user_id', auth()->user()->id)->count() > 0) {
            // Crear el mensaje de error
            session()->flash('error', 'Ya postulaste a esta vacante anteriormente');
        } else {



            //almacenar CV en el dipsositivo 
            $cv = $this->cv->store('public/cv');
            $datos['cv'] = str_replace('public/cv/', '', $cv);

            //Crear el candidato a la vacante 
            $this->vacante->candidatos()->create([
                'user_id' => auth()->user()->id, #Este es el usuario que se esta postulando para la vacante 
                'cv' => $datos['cv']
                #En este caso no agregamos la vacante_id por que ya lo hicmos con la relacion 
            ]);

            //Crear notificacion y enviar el email 
            #La notificacion va a tomar la informacion que le queramos enviar al usuario >
            $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));
            //Mostrar al usuario un mensaje de ok 
            session()->flash('mensaje', 'Se envio correctamente tu informacion, mucha suerte. ');

            return redirect()->back();
        }
    }
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
