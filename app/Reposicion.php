<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reposicion extends Model
{
    public function ausencia(){
        return $this->belongsTo(Ausencia::class);
    }
}
