<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    public function sufacultad(){ //$libro->categoria->nombre
        return $this->belongsTo(Facultad::class); //Pertenece a una categoría.
    }
}
