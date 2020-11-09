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
    
    public function crearPermisos(){

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'facultad']);
        Permission::create(['name' => 'departamento']);
        Permission::create(['name' => 'materia']);
        Permission::create(['name' => 'carrera']);
        Permission::create(['name' => 'gestion']);

        Permission::create(['name' => 'usuario']);
        Permission::create(['name' => 'rol']);

        Permission::create(['name' => 'asignacion']);
        Permission::create(['name' => 'asistencia-avance']);
        Permission::create(['name' => 'ausencia-reposicion']);

        return redirect ('/configuracion');
    }

    public function crearHorasyDias(){
        $lunes = Dia::create([
            'dia' => 'Lunes',
        ]);

        $martes = Dia::create([
            'dia' => 'Martes',
        ]);
        $miercoles = Dia::create([
            'dia' => 'Miercoles',
        ]);
        $jueves = Dia::create([
            'dia' => 'Jueves',
        ]);
        $viernes = Dia::create([
            'dia' => 'Viernes',
        ]);
        $sabado = Dia::create([
            'dia' => 'Sabado',
        ]);


        $primera = Hora::create([
            'hora' => '6:45 - 8:15',
        ]);
        $segunda = Hora::create([
            'hora' => '8:15 - 9:45',
        ]);
        $tercera = Hora::create([
            'hora' => '9:45 - 11:15',
        ]);
        $cuarta = Hora::create([
            'hora' => '11:15 - 12:45',
        ]);
        $quinta = Hora::create([
            'hora' => '12:45 - 14:15',
        ]);
        $sexta = Hora::create([
            'hora' => '14:15 - 15:45',
        ]);
        $septima = Hora::create([
            'hora' => '15:45 - 17:15',
        ]);
        $octava = Hora::create([
            'hora' => '17:15 - 18:45',
        ]);
        $novena = Hora::create([
            'hora' => '18:45 - 21:45',
        ]);
  
        return redirect ('/configuracion');

    }
}
