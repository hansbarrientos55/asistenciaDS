<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ausencia extends Model
{
    public function user() {
        return $this->belongsToMany(User::class);
    }
}
