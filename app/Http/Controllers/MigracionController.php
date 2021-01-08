<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\MigracionCSV;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Asignacion;
use App\Asistencia;
use App\Ausencia;
use App\Reposicion;
use App\Bitacora;
use App\Carrera;
use App\Departamento;
use App\Dia;
use App\Facultad;
use App\Gestion;
use App\Grupo;
use App\Horario;
use App\Hora;
use App\Materia;
use App\Mensual;
use Illuminate\Support\Facades\DB;
use App\Event;
use Illuminate\Support\Facades\Storage;
use Response;

use Artisan;
use Carbon\Carbon;
use Log;
use Spatie\Backup\Helpers\Format;




class MigracionController extends Controller
{

    public function index(){

        return view('migracion.index');
    }
    
    public function generarPostgre(){
        $salida ='';
        
        //Usuarios
        $usuarios = User::all();
        $salida = "INSERT INTO \"users\" (\"id\", \"nombres\", \"apellidos\", \"cedula\", \"fechanacimiento\", \"direccion\", \"profesion\", \"username\", \"contrasenia\", \"password\", \"emailprincipal\", \"emailsecundario\", \"telefonoprincipal\", \"telefonosecundario\", \"estaactivo\", \"rolprimario\", \"rolsecundario\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($usuarios as $list){
            $salida .= "(".$list->id.", '".$list->nombres."', '".$list->apellidos."', '".$list->cedula."', '".$list->fechanacimiento."', '".$list->direccion."', '".$list->profesion."', '".$list->username."', '".$list->contrasenia."', '".$list->password."', '".$list->emailprincipal."', '".$list->emailsecundario."', '".$list->telefonoprincipal."', '".$list->telefonosecundario."', '".$list->estaactivo."', '".$list->rolprimario."', '".$list->rolsecundario."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Permisos
        $permisos = Permission::all();
        $salida .= "\n INSERT INTO \"permissions\" (\"id\", \"name\", \"guard_name\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($permisos as $list){
            $salida .= "(".$list->id.", '".$list->name."', '".$list->guard_name."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";


        //Roles
        $roles = Role::all();
        $salida .= "\n INSERT INTO \"roles\" (\"id\", \"name\", \"guard_name\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($roles as $list){
            $salida .= "(".$list->id.", '".$list->name."', '".$list->guard_name."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";


        // Asignaciones
        $asignaciones = Asignacion::all();
        $salida .= "\n INSERT INTO \"asignacions\" (\"id\", \"gestion\", \"departamento\", \"docente\", \"nomdocente\", \"auxiliardocencia\", \"nomauxdocencia\", \"auxiliarlabo\", \"nomauxlabo\", \"materia\", \"nommateria\", \"grupo\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($asignaciones as $list){
            $salida .= "(".$list->id.", '".$list->gestion."', '".$list->departamento."', '".$list->docente."', '".$list->nomdocente."', '".$list->auxiliardocencia."', '".$list->nomauxdocencia."', '".$list->auxiliarlabo."', '".$list->nomauxlabo."', '".$list->materia."', '".$list->nommateria."', '".$list->grupo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        // Asistencias
        $asistencias = Asistencia::all();
        $salida .= "\n INSERT INTO \"asistencias\" (\"id\", \"user_id\", \"tipo\", \"fecha\", \"hora\", \"mes\", \"iniciosemana\", \"finsemana\", \"horario\", \"grupo\", \"materia\", \"contenido\", \"repositorio\", \"notificacion\", \"claseonline\", \"observaciones\", \"firma\", \"archivo\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($asistencias as $list){
            $salida .= "(".$list->id.", '".$list->user_id."', '".$list->tipo."', '".$list->fecha."', '".$list->hora."', '".$list->mes."', '".$list->iniciosemana."', '".$list->finsemana."', '".$list->horario."', '".$list->grupo."', '".$list->materia."', '".$list->contenido."', '".$list->repositorio."', '".$list->notificacion."', '".$list->claseonline."', '".$list->observaciones."', '".$list->firma."', '".$list->archivo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Ausencias
        $ausencias = Ausencia::all();
        $salida .= "\n INSERT INTO \"ausencias\" (\"id\", \"user_id\", \"fecha\", \"hora\", \"motivo\", \"fechaausencia\", \"horaausencia\", \"estaaceptada\", \"archivo\", \"label\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($ausencias as $list){
            $salida .= "(".$list->id.", '".$list->user_id."', '".$list->fecha."', '".$list->hora."', '".$list->motivo."', '".$list->fechaausencia."', '".$list->horaausencia."', '".$list->estaaceptada."', '".$list->archivo."', '".$list->label."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Reposiciones
        $reposiciones = Reposicion::all();
        $salida .= "\n INSERT INTO \"reposicions\" (\"id\", \"ausencia_id\", \"fecha\", \"hora\", \"nuevafecha\", \"horario\", \"grupo\", \"materia\", \"contenido\", \"plataforma\", \"observaciones\", \"estado\", \"label\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($reposiciones as $list){
            $salida .= "(".$list->id.", '".$list->ausencia_id."', '".$list->fecha."', '".$list->hora."', '".$list->nuevafecha."', '".$list->horario."', '".$list->grupo."', '".$list->materia."', '".$list->contenido."', '".$list->plataforma."', '".$list->observaciones."', '".$list->estado."', '".$list->label."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Bitacoras
        $bitacoras = Bitacora::all();
        $salida .= "\n INSERT INTO \"bitacoras\" (\"id\", \"user_id\", \"usuario\", \"rol\", \"fecha\", \"hora\", \"accion\", \"direccion_ip\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($bitacoras as $list){
            $salida .= "(".$list->id.", '".$list->user_id."', '".$list->usuario."', '".$list->rol."', '".$list->fecha."', '".$list->hora."', '".$list->accion."', '".$list->direccion_ip."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Carreras
        $carreras = Carrera::all();
        $salida .= "\n INSERT INTO \"carreras\" (\"id\", \"codigocarrera\", \"nombrecarrera\", \"descripcioncarrera\", \"estaactivo\", \"facultad_id\", \"facultad_nombre\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($carreras as $list){
            $salida .= "(".$list->id.", '".$list->codigocarrera."', '".$list->nombrecarrera."', '".$list->descripcioncarrera."', '".$list->estaactivo."', '".$list->facultad_id."', '".$list->facultad_nombre."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Departamentos
        $departamentos = Departamento::all();
        $salida .= "\n INSERT INTO \"departamentos\" (\"id\", \"nombredepa\", \"descripciondepa\", \"estaactivo\", \"facultad_id\", \"facultad_nombre\",\"created_at\", \"updated_at\") VALUES \n";
        foreach($departamentos as $list){
            $salida .= "(".$list->id.", '".$list->nombredepa."', '".$list->descripciondepa."', '".$list->estaactivo."', '".$list->facultad_id."', '".$list->facultad_nombre."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Dias
        $dias = Dia::all();
        $salida .= "\n INSERT INTO \"dias\" (\"id\", \"dia\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($dias as $list){
            $salida .= "(".$list->id.", '".$list->dia."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Facultades
        $facultades = Facultad::all();
        $salida .= "\n INSERT INTO \"facultads\" (\"id\", \"nombrefacu\", \"descripcionfacu\", \"estaactivo\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($facultades as $list){
            $salida .= "(".$list->id.", '".$list->nombrefacu."', '".$list->descripcionfacu."', '".$list->estaactivo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Gestiones
        $gestiones = Gestion::all();
        $salida .= "\n INSERT INTO \"gestions\" (\"id\", \"periodogestion\", \"añogestion\", \"gestion\", \"estaactivo\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($gestiones as $list){
            $salida .= "(".$list->id.", '".$list->periodogestion."', '".$list->añogestion."', '".$list->gestion."', '".$list->estaactivo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Grupos
        $grupos = Grupo::all();
        $salida .= "\n INSERT INTO \"grupos\" (\"id\", \"numerogrupo\", \"estaactivo\", \"materia_id\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($grupos as $list){
            $salida .= "(".$list->id.", '".$list->numerogrupo."', '".$list->estaactivo."', '".$list->materia_id."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Horarios
        $horarios = Horario::all();
        $salida .= "\n INSERT INTO \"horarios\" (\"id\", \"titulo\", \"hora\", \"dia\", \"grupo_id\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($horarios as $list){
            $salida .= "(".$list->id.", '".$list->titulo."', '".$list->hora."', '".$list->dia."', '".$list->grupo_id."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Horas
        $horas = Hora::all();
        $salida .= "\n INSERT INTO \"horas\" (\"id\", \"hora\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($horas as $list){
            $salida .= "(".$list->id.", '".$list->hora."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Materias
        $materias = Materia::all();
        $salida .= "\n INSERT INTO \"materias\" (\"id\", \"codigomate\", \"nombremate\", \"descripcionmate\", \"nivelmate\", \"estaactivo\", \"departamento_id\", \"departamento_nombre\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($materias as $list){
            $salida .= "(".$list->id.", '".$list->codigomate."', '".$list->nombremate."', '".$list->descripcionmate."', '".$list->nivelmate."', '".$list->estaactivo."', '".$list->departamento_id."', '".$list->departamento_nombre."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Mensuales
        $mensuales = Mensual::all();
        $salida .= "\n INSERT INTO \"mensuals\" (\"id\", \"user_id\", \"fecha\", \"hora\", \"mes\", \"vistobueno\", \"firma\", \"horas\", \"archivo\", \"created_at\", \"updated_at\") VALUES \n";
        foreach($mensuales as $list){
            $salida .= "(".$list->id.", '".$list->user_id."', '".$list->fecha."', '".$list->hora."', '".$list->mes."', '".$list->vistobueno."', '".$list->firma."', '".$list->horas."', '".$list->archivo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        // model has roles
        $modelroles = DB::table('model_has_roles')->get();
        $salida .= "\n INSERT INTO \"model_has_roles\" (\"role_id\", \"model_type\", \"model_id\") VALUES \n";
        foreach($modelroles as $list){
            $salida .= "(".$list->role_id.", '".$list->model_type."', '".$list->model_id."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //role has permissions
        $rolepermissions = DB::table('role_has_permissions')->get();
        $salida .= "\n INSERT INTO \"role_has_permissions\" (\"permission_id\", \"role_id\") VALUES \n";
        foreach($rolepermissions as $list){
            $salida .= "(".$list->permission_id.", '".$list->role_id."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";
        
        // migraciones de laravel
        $migraciones = DB::table('migrations')->get();
        $salida .= "\n INSERT INTO \"migrations\" (\"id\", \"migration\", \"batch\") VALUES \n";
        foreach($migraciones as $list){
            $salida .= "(".$list->id.", '".$list->migration."', '".$list->batch."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Eventos
        //Materias
        $eventos = Event::all();
        $salida .= "\n INSERT INTO \"events\" (\"id\", \"title\", \"start\", \"end\", \"creator\", \"type\",\"created_at\", \"updated_at\") VALUES \n";
        foreach($eventos as $list){
            $salida .= "(".$list->id.", '".$list->title."', '".$list->start."', '".$list->end."', '".$list->creator."', '".$list->type."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";
        


        //$archivo = 'BaseDeDatos-ControlAsistenciaAvance.sql';
        //Storage::disk('local')->put($archivo, $salida);
        //file_put_contents($archivo, $salida);        

        //dd($salida);

        return Response::make($salida, '200', array(
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="BD-PostgreSQL-ControlAsistenciaAvance.sql"'
        ));



    }

    public function generarMy(){
        $salida ='';
        
        //Usuarios
        $usuarios = User::all();
        $salida = "INSERT INTO `users` (`id`, `nombres`, `apellidos`, `cedula`, `fechanacimiento`, `direccion`, `profesion`, `username`, `contrasenia`, `password`, `emailprincipal`, `emailsecundario`, `telefonoprincipal`, `telefonosecundario`, `estaactivo`, `rolprimario`, `rolsecundario`, `created_at`, `updated_at`) VALUES \n";
        foreach($usuarios as $list){
            $salida .= "(".$list->id.", '".$list->nombres."', '".$list->apellidos."', '".$list->cedula."', '".$list->fechanacimiento."', '".$list->direccion."', '".$list->profesion."', '".$list->username."', '".$list->contrasenia."', '".$list->password."', '".$list->emailprincipal."', '".$list->emailsecundario."', '".$list->telefonoprincipal."', '".$list->telefonosecundario."', '".$list->estaactivo."', '".$list->rolprimario."', '".$list->rolsecundario."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Permisos
        $permisos = Permission::all();
        $salida .= "\n INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES \n";
        foreach($permisos as $list){
            $salida .= "(".$list->id.", '".$list->name."', '".$list->guard_name."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";


        //Roles
        $roles = Role::all();
        $salida .= "\n INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES \n";
        foreach($roles as $list){
            $salida .= "(".$list->id.", '".$list->name."', '".$list->guard_name."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";


        // Asignaciones
        $asignaciones = Asignacion::all();
        $salida .= "\n INSERT INTO `asignacions` (`id`, `gestion`, `departamento`, `docente`, `materia`, `grupo`, `created_at`, `updated_at`) VALUES \n";
        foreach($asignaciones as $list){
            $salida .= "(".$list->id.", '".$list->gestion."', '".$list->departamento."', '".$list->docente."', '".$list->materia."', '".$list->grupo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        // Asistencias
        $asistencias = Asistencia::all();
        $salida .= "\n INSERT INTO `asistencias` (`id`, `user_id`, `tipo`, `fecha`, `hora`, `mes`, `iniciosemana`, `finsemana`, `horario`, `grupo`, `materia`, `contenido`, `repositorio`, `notificacion`, `claseonline`, `observaciones`, `firma`, `archivo`, `created_at`, `updated_at`) VALUES \n";
        foreach($asistencias as $list){
            $salida .= "(".$list->id.", '".$list->user_id."', '".$list->tipo."', '".$list->fecha."', '".$list->hora."', '".$list->mes."', '".$list->iniciosemana."', '".$list->finsemana."', '".$list->horario."', '".$list->grupo."', '".$list->materia."', '".$list->contenido."', '".$list->repositorio."', '".$list->notificacion."', '".$list->claseonline."', '".$list->observaciones."', '".$list->firma."', '".$list->archivo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Ausencias
        $ausencias = Ausencia::all();
        $salida .= "\n INSERT INTO `ausencias` (`id`, `user_id`, `fecha`, `hora`, `motivo`, `fechaausencia`, `horaausencia`, `estaaceptada`, `archivo`, `label`, `created_at`, `updated_at`) VALUES \n";
        foreach($ausencias as $list){
            $salida .= "(".$list->id.", '".$list->user_id."', '".$list->fecha."', '".$list->hora."', '".$list->motivo."', '".$list->fechaausencia."', '".$list->horaausencia."', '".$list->estaaceptada."', '".$list->archivo."', '".$list->label."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Reposiciones
        $reposiciones = Reposicion::all();
        $salida .= "\n INSERT INTO `reposicions` (`id`, `ausencia_id`, `fecha`, `hora`, `nuevafecha`, `horario`, `grupo`, `materia`, `contenido`, `plataforma`, `observaciones`, `estado`, `label`, `created_at`, `updated_at`) VALUES \n";
        foreach($reposiciones as $list){
            $salida .= "(".$list->id.", '".$list->ausencia_id."', '".$list->fecha."', '".$list->hora."', '".$list->nuevafecha."', '".$list->horario."', '".$list->grupo."', '".$list->materia."', '".$list->contenido."', '".$list->plataforma."', '".$list->observaciones."', '".$list->estado."', '".$list->label."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Bitacoras
        $bitacoras = Bitacora::all();
        $salida .= "\n INSERT INTO `bitacoras` (`id`, `user_id`, `usuario`, `rol`, `fecha`, `hora`, `accion`, `direccion_ip`, `created_at`, `updated_at`) VALUES \n";
        foreach($bitacoras as $list){
            $salida .= "(".$list->id.", '".$list->user_id."', '".$list->usuario."', '".$list->rol."', '".$list->fecha."', '".$list->hora."', '".$list->accion."', '".$list->direccion_ip."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Carreras
        $carreras = Carrera::all();
        $salida .= "\n INSERT INTO `carreras` (`id`, `codigocarrera`, `nombrecarrera`, `descripcioncarrera`, `estaactivo`, `facultad_id`, `facultad_nombre`, `created_at`, `updated_at`) VALUES \n";
        foreach($carreras as $list){
            $salida .= "(".$list->id.", '".$list->codigocarrera."', '".$list->nombrecarrera."', '".$list->descripcioncarrera."', '".$list->estaactivo."', '".$list->facultad_id."', '".$list->facultad_nombre."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Departamentos
        $departamentos = Departamento::all();
        $salida .= "\n INSERT INTO `departamentos` (`id`, `nombredepa`, `descripciondepa`, `estaactivo`, `facultad_id`, `facultad_nombre`, `created_at`, `updated_at`) VALUES \n";
        foreach($departamentos as $list){
            $salida .= "(".$list->id.", '".$list->nombredepa."', '".$list->descripciondepa."', '".$list->estaactivo."', '".$list->facultad_id."', '".$list->facultad_nombre."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Dias
        $dias = Dia::all();
        $salida .= "\n INSERT INTO `dias` (`id`, `dia`, `created_at`, `updated_at`) VALUES \n";
        foreach($dias as $list){
            $salida .= "(".$list->id.", '".$list->dia."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Facultades
        $facultades = Facultad::all();
        $salida .= "\n INSERT INTO `facultads` (`id`, `nombrefacu`, `descripcionfacu`, `estaactivo`, `created_at`, `updated_at`) VALUES \n";
        foreach($facultades as $list){
            $salida .= "(".$list->id.", '".$list->nombrefacu."', '".$list->descripcionfacu."', '".$list->estaactivo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Gestiones
        $gestiones = Gestion::all();
        $salida .= "\n INSERT INTO `gestions` (`id`, `periodogestion`, `añogestion`, `gestion`, `estaactivo`, `created_at`, `updated_at`) VALUES \n";
        foreach($gestiones as $list){
            $salida .= "(".$list->id.", '".$list->periodogestion."', '".$list->añogestion."', '".$list->gestion."', '".$list->estaactivo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Grupos
        $grupos = Grupo::all();
        $salida .= "\n INSERT INTO `grupos` (`id`, `numerogrupo`, `estaactivo`, `materia_id`, `created_at`, `updated_at`) VALUES \n";
        foreach($grupos as $list){
            $salida .= "(".$list->id.", '".$list->numerogrupo."', '".$list->estaactivo."', '".$list->materia_id."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Horarios
        $horarios = Horario::all();
        $salida .= "\n INSERT INTO `horarios` (`id`, `titulo`, `hora`, `dia`, `grupo_id`, `created_at`, `updated_at`) VALUES \n";
        foreach($horarios as $list){
            $salida .= "(".$list->id.", '".$list->titulo."', '".$list->hora."', '".$list->dia."', '".$list->grupo_id."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Horas
        $horas = Hora::all();
        $salida .= "\n INSERT INTO `horas` (`id`, `hora`, `created_at`, `updated_at`) VALUES \n";
        foreach($horas as $list){
            $salida .= "(".$list->id.", '".$list->hora."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Materias
        $materias = Materia::all();
        $salida .= "\n INSERT INTO `materias` (`id`, `codigomate`, `nombremate`, `descripcionmate`, `nivelmate`, `estaactivo`, `departamento_id`, `departamento_nombre`, `created_at`, `updated_at`) VALUES \n";
        foreach($materias as $list){
            $salida .= "(".$list->id.", '".$list->codigomate."', '".$list->nombremate."', '".$list->descripcionmate."', '".$list->nivelmate."', '".$list->estaactivo."', '".$list->departamento_id."', '".$list->departamento_nombre."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Mensuales
        $mensuales = Mensual::all();
        $salida .= "\n INSERT INTO `mensuals` (`id`, `user_id`, `fecha`, `hora`, `mes`, `vistobueno`, `firma`, `horas`, `archivo`, `created_at`, `updated_at`) VALUES \n";
        foreach($mensuales as $list){
            $salida .= "(".$list->id.", '".$list->user_id."', '".$list->fecha."', '".$list->hora."', '".$list->mes."', '".$list->vistobueno."', '".$list->firma."', '".$list->horas."', '".$list->archivo."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        // model has roles
        $modelroles = DB::table('model_has_roles')->get();
        $salida .= "\n INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES \n";
        foreach($modelroles as $list){
            $salida .= "(".$list->role_id.", '".$list->model_type."', '".$list->model_id."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //role has permissions
        $rolepermissions = DB::table('role_has_permissions')->get();
        $salida .= "\n INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES \n";
        foreach($rolepermissions as $list){
            $salida .= "(".$list->permission_id.", '".$list->role_id."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";
        
        // migraciones de laravel
        $migraciones = DB::table('migrations')->get();
        $salida .= "\n INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES \n";
        foreach($migraciones as $list){
            $salida .= "(".$list->id.", '".$list->migration."', '".$list->batch."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";

        //Eventos
        //Materias
        $eventos = Event::all();
        $salida .= "\n INSERT INTO `events` (`id`, `title`, `start`, `end`,`created_at`, `updated_at`) VALUES \n";
        foreach($eventos as $list){
            $salida .= "(".$list->id.", '".$list->title."', '".$list->start."', '".$list->end."', '".$list->created_at."', '".$list->updated_at."'),";

        }
        $salida = substr($salida,0,-1);
        $salida .=";\n";
        


        //$archivo = 'BaseDeDatos-ControlAsistenciaAvance.sql';
        //Storage::disk('local')->put($archivo, $salida);
        //file_put_contents($archivo, $salida);        

        //dd($salida);

        return Response::make($salida, '200', array(
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="BD-MySQL-ControlAsistenciaAvance.sql"'
        ));



    }

    public function respaldaraplicacion()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', ['--only-files' => 'true']);
            //Artisan::call('backup:run');
            $output = Artisan::output();
            //dd($output);
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            //Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
}