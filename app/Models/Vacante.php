<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;
    // protected $dates=['ultimo_dia']; 
    protected $casts = ['ultimo_dia' => 'date']; #Indi8camos que el tipo datos es tipo fecha 
    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];
    #Relaciones 
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }
    public function candidatos()
    {
        return $this->hasMany(Candidato::class)->orderBy('created_at','DESC');
    }
    public function reclutador()
    {
        #Indicamos que esta relacion va a aser hacia la persona que publico la vacante
        return $this->belongsTo(User::class,'user_id');
    }
}
