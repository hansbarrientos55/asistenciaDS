<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public function grupo(){ //$libro->categoria->nombre
        return $this->belongsTo(Grupo::class); //Pertenece a una categoría.
    }
}
