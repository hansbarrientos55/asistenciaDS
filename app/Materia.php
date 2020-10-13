<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public function departamento(){ //$libro->categoria->nombre
        return $this->belongsTo(Departamento::class); //Pertenece a una categoría.
    }
}
