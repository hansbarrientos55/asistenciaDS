<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public function materia(){ //$libro->categoria->nombre
        return $this->belongsTo(Materia::class); //Pertenece a una categoría.
    }
}
