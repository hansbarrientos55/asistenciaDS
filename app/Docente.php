<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    public function suuser(){ //$libro->categoria->nombre
        return $this->belongsTo(User::class); //Pertenece a una categoría.
    }
}
