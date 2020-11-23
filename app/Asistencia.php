<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'fecha', 
           'hora', 
           'mes', 
           'iniciosemana',
            'finsemana', 
            'tipo',
            'grupo', 
            'materia', 
            'contenido', 
            'plataforma',
            'observaciones', 
            'firma',
            'archivo'
    ];
}
