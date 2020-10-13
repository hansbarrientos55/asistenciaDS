<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    public function facultad(){ //$libro->categoria->nombre
        return $this->belongsTo(Facultad::class); //Pertenece a una categoría.
    }
}
