<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Hora;
use App\Dia;

class ControlConfiguracionController extends Controller
{
    public function index(){

        return view ('configuracion.index');
    }
    
    
}
