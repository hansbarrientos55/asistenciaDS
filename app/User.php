<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres', 'apellidos', 'cedula', 'fechanacimiento', 'cedula', 'direccion', 'profesion', 'username', 'contrasenia', 'password','emailprincipal','emailsecundario','telefonoprincipal','telefonosecundario', 'estaactivo', 'rolprimario','rolsecundario','rolprimariotexto', 'rolsecundariotexto',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'contrasenia', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function asignacions(){
        return $this->hasMany(Asignacion::class);
    }
}
