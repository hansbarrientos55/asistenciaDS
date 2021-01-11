<?php

namespace App\Http\Controllers;


use App\Asistencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Materia;
use App\Grupo;
use App\Hora;
use Auth;
use App\Bitacora;
use App\User;
use App\Asignacion;
use App\Horario;
use App\Rules\AsistenciaSinRepetir;
use App\Rules\AsistenciaActualizar;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu()
    {

        return view('asistencia.menu');
    }

    public function index()
    {
        //$asistencias = Asistencia::all();
        $asistencias = Asistencia::where('user_id',Auth::id())->get();
        return view('asistencia.index',compact('asistencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function materia()
    {

        $usuario = Auth::id();
        
        $asignacionusuario = Asignacion::where('docente', $usuario)->get();
        
        $materias = new \Illuminate\Database\Eloquent\Collection; 

        foreach($asignacionusuario as $item){
            $mataux = Materia::where('id',$item->materia)->get();

            $materias->push($mataux);
        }

        //dd($materias);
        
        return view('asistencia.materia', compact('materias'));
    }

    public function grupo(Request $request)
    {
        $materia = $request['materia'];
        $nombremateria = Materia::where('id',$materia)->value('nombremate');
        $grupos = Grupo::where('materia_id',$materia)->get();

        //dd($grupos);
        
        return view('asistencia.grupo', compact('grupos', 'materia', 'nombremateria'));
    }

    public function horario(Request $request)
    {
        $materia = $request['materia'];
        $nombremateria = $request['nombremateria'];
        $grupo = $request['grupo'];
        $nombregrupo = Grupo::where('id',$grupo)->value('numerogrupo');
        
        $horarios = Horario::where('grupo_id',$grupo)->get();

        //dd($horarios);
        
        return view('asistencia.horario', compact('horarios','materia','nombremateria','grupo','nombregrupo'));
    }


    public function datos(Request $request)
    {
        $user_id = Auth::id();
        $materia = $request['materia'];
        $nombremateria = $request['nombremateria'];
        $grupo = $request['grupo'];
        $nombregrupo = $request['nombregrupo'];
        $horario = $request['horario'];
        $titulohorario = Horario::where('id',$horario)->value('titulo');

        
        $fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $mes = Carbon::now()->format('F');

        switch($mes){
            case 'January' : $mes = "Enero";
            break;
            case 'February' : $mes = "Febrero";
            break;
            case 'March' : $mes = "Marzo";
            break;
            case 'April' : $mes = "Abril";
            break;
            case 'May' : $mes = "Mayo";
            break;
            case 'June' : $mes = "Junio";
            break;
            case 'July' : $mes = "Julio";
            break;
            case 'August' : $mes = "Agosto";
            break;
            case 'September' : $mes = "Septiembre";
            break;
            case 'October' : $mes = "Octubre";
            break;
            case 'November' : $mes = "Noviembre";
            break;
            case 'December' : $mes = "Diciembre";
            break;
        }

        $month = Carbon::now()->startOfWeek()->format('m');
        $ini = Carbon::now()->startOfWeek()->format('d');
        $fin = Carbon::now()->endOfWeek()->format('d');
        $iniciosemana = $month.'/'.$ini;
        $finsemana = $month.'/'.$fin;

        
        return view('asistencia.datos', compact('fecha', 'hora', 'mes','iniciosemana','finsemana', 'materia', 'nombremateria', 'grupo', 'nombregrupo', 'horario', 'titulohorario','user_id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        //$datosAsistencia=request()->except('_token');
        //$usuario = Auth::id();
        //Asistencia::insert($datosAsistencia);

        $usuario = $request['user_id'];
        $materia = $request['materia'];
        $grupo = $request['grupo'];
        $horario = $request['horario'];
        $fecha = $request['fecha'];

        //dd($request);

        $this->validate($request, ['tipo' => ['required', new AsistenciaSinRepetir($usuario,$materia,$grupo,$horario,$fecha)]]);

        

        if ($request->file('archivo') == null) {
            $real = "";
        }else{
           $real = $request->file('archivo')->store('public');  
        }

        //dd($request);

        $asistencia = new Asistencia;
        $asistencia->user_id = Auth::id();
        $asistencia->tipo = $request->tipo;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora = $request->hora;
        $asistencia->mes = $request->mes;
        $asistencia->iniciosemana = $request->iniciosemana;
        $asistencia->finsemana = $request->finsemana;
        $asistencia->horario = $request->horario;
        $asistencia->titulohorario = $request->titulohorario;
        $asistencia->grupo = $request->grupo;
        $asistencia->nombregrupo = $request->nombregrupo;
        $asistencia->materia = $request->materia;
        $asistencia->nombremateria = $request->nombremateria;
        $asistencia->contenido = $request->contenido;
        $asistencia->repositorio = $request->repositorio;
        $asistencia->notificacion = $request->notificacion;
        $asistencia->claseonline = $request->claseonline;
        $asistencia->observaciones = $request->observaciones;
        $asistencia->firma = $request->firma;
        $asistencia->archivo =$real;
        $asistencia->grabacion = $request->grabacion;
        $asistencia->tarea= $request->tarea;

        $asistencia->save();


        $bitacora = new Bitacora;
        $bitacora->user_id = Auth::id();
        $consulta = User::where('id',Auth::id())->select("nombres","apellidos","rolprimario","rolsecundario")->get();
        foreach($consulta as $item){
            $nombres = $item->nombres;
            $apellidos = $item->apellidos;
            $rolprimario = $item->rolprimario;
            $rolsecundario = $item->rolsecundario;
        }
        
        $bitacora->usuario = $nombres." ".$apellidos;
        $bitacora->rol = $rolprimario.", ".$rolsecundario;
        $bitacora->fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $bitacora->hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $bitacora->accion = "Registrada asistencia de clase";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

       // return response()->json($datosDepartamento);
       return redirect('asistencia');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asi = Asistencia::findOrFail($id);
        $materias = Materia::all();
        $grupos = Grupo::all();
        $horarios = Hora::all();
        return view('asistencia.edit', compact('asi','materias','grupos', 'horarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosasistencia=request()->except(['_token','_method']);
        asistencia::where('id','=',$id)->update($datosasistencia);


        $bitacora = new Bitacora;
        $bitacora->user_id = Auth::id();
        $consulta = User::where('id',Auth::id())->select("nombres","apellidos","rolprimario","rolsecundario")->get();
        foreach($consulta as $item){
            $nombres = $item->nombres;
            $apellidos = $item->apellidos;
            $rolprimario = $item->rolprimario;
            $rolsecundario = $item->rolsecundario;
        }
        
        $bitacora->usuario = $nombres." ".$apellidos;
        $bitacora->rol = $rolprimario.", ".$rolsecundario;
        $bitacora->fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $bitacora->hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $bitacora->accion = "Editada asistencia de clase";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('asistencia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        asistencia::destroy($id);

        $bitacora = new Bitacora;
        $bitacora->user_id = Auth::id();
        $consulta = User::where('id',Auth::id())->select("nombres","apellidos","rolprimario","rolsecundario")->get();
        foreach($consulta as $item){
            $nombres = $item->nombres;
            $apellidos = $item->apellidos;
            $rolprimario = $item->rolprimario;
            $rolsecundario = $item->rolsecundario;
        }
        
        $bitacora->usuario = $nombres." ".$apellidos;
        $bitacora->rol = $rolprimario.", ".$rolsecundario;
        $bitacora->fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $bitacora->hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $bitacora->accion = "Eliminada asistencia a clase";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('asistencia');
    }

    public function list()
    {
        $asistencias = Asistencia::all();
        return view('asistencia.list',compact('asistencias'));
    }

    public function materiaeditar($id)
    {

        $asi = Asistencia::findOrFail($id);

        $usuario = Auth::id();
        
        $asignacionusuario = Asignacion::where('docente', $usuario)->get();
        
        $materias = new \Illuminate\Database\Eloquent\Collection; 

        foreach($asignacionusuario as $item){
            $mataux = Materia::where('id',$item->materia)->get();

            $materias->push($mataux);
        }

        //dd($materias);
        
        return view('asistencia.materiaeditar', compact('asi','materias'));
    }

    public function grupoeditar(Request $request)
    {
        
        $asi = $request['llave'];
        $materia = $request['materia'];
        $nombremateria = Materia::where('id',$materia)->value('nombremate');
        $grupos = Grupo::where('materia_id',$materia)->get();

        //dd($grupos);
        
        return view('asistencia.grupoeditar', compact('grupos', 'materia', 'nombremateria', 'asi'));
    }

    public function horarioeditar(Request $request)
    {

        $asi = $request['llave'];
        
        $materia = $request['materia'];
        $nombremateria = $request['nombremateria'];
        $grupo = $request['grupo'];
        $nombregrupo = Grupo::where('id',$grupo)->value('numerogrupo');
        
        $horarios = Horario::where('grupo_id',$grupo)->get();

        //dd($horarios);
        
        return view('asistencia.horarioeditar', compact('horarios','materia','nombremateria','grupo','nombregrupo','asi'));
    }


    public function datoseditar(Request $request)
    {
        $llave = $request['llave'];
        $contenido = Asistencia::where('id',$llave)->value('contenido');
        $observaciones = Asistencia::where('id',$llave)->value('observaciones');
        $firma = Asistencia::where('id',$llave)->value('firma');
        $contenido = Asistencia::where('id',$llave)->value('contenido');
        $grabacion = Asistencia::where('id',$llave)->value('grabacion');
        $tarea = Asistencia::where('id',$llave)->value('tarea');

        
        $user_id = Auth::id();
        $materia = $request['materia'];
        $nombremateria = $request['nombremateria'];
        $grupo = $request['grupo'];
        $nombregrupo = $request['nombregrupo'];
        $horario = $request['horario'];
        $titulohorario = Horario::where('id',$horario)->value('titulo');

        
        $fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $mes = Carbon::now()->format('F');

        switch($mes){
            case 'January' : $mes = "Enero";
            break;
            case 'February' : $mes = "Febrero";
            break;
            case 'March' : $mes = "Marzo";
            break;
            case 'April' : $mes = "Abril";
            break;
            case 'May' : $mes = "Mayo";
            break;
            case 'June' : $mes = "Junio";
            break;
            case 'July' : $mes = "Julio";
            break;
            case 'August' : $mes = "Agosto";
            break;
            case 'September' : $mes = "Septiembre";
            break;
            case 'October' : $mes = "Octubre";
            break;
            case 'November' : $mes = "Noviembre";
            break;
            case 'December' : $mes = "Diciembre";
            break;
        }

        $month = Carbon::now()->startOfWeek()->format('m');
        $ini = Carbon::now()->startOfWeek()->format('d');
        $fin = Carbon::now()->endOfWeek()->format('d');
        $iniciosemana = $month.'/'.$ini;
        $finsemana = $month.'/'.$fin;

        
        return view('asistencia.datoseditar', compact('fecha', 'hora', 'mes','iniciosemana','finsemana', 'materia', 'nombremateria', 'grupo', 'nombregrupo', 'horario', 'titulohorario','user_id', 'llave', 'contenido', 'observaciones', 'firma', 'grabacion', 'tarea'));
    }

    public function actualizar(Request $request)
    {
        //$datosAsistencia=request()->except('_token');
        //$usuario = Auth::id();
        //Asistencia::insert($datosAsistencia);

        $asi = $request['llave'];
        $usuario = $request['user_id'];
        $materia = $request['materia'];
        $grupo = $request['grupo'];
        $horario = $request['horario'];
        $fecha = $request['fecha'];

        //dd($request);

        $this->validate($request, ['tipo' => ['required', new AsistenciaActualizar($usuario,$materia,$grupo,$horario,$fecha,$asi)]]);

        

        if ($request->file('archivo') == null) {
            $real = "";
        }else{
           $real = $request->file('archivo')->store('public');  
        }

        //dd($request);

        $asistencia = Asistencia::findOrFail($asi);
        $asistencia->user_id = Auth::id();
        $asistencia->tipo = $request->tipo;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora = $request->hora;
        $asistencia->mes = $request->mes;
        $asistencia->iniciosemana = $request->iniciosemana;
        $asistencia->finsemana = $request->finsemana;
        $asistencia->horario = $request->horario;
        $asistencia->titulohorario = $request->titulohorario;
        $asistencia->grupo = $request->grupo;
        $asistencia->nombregrupo = $request->nombregrupo;
        $asistencia->materia = $request->materia;
        $asistencia->nombremateria = $request->nombremateria;
        $asistencia->contenido = $request->contenido;
        $asistencia->repositorio = $request->repositorio;
        $asistencia->notificacion = $request->notificacion;
        $asistencia->claseonline = $request->claseonline;
        $asistencia->observaciones = $request->observaciones;
        $asistencia->firma = $request->firma;
        $asistencia->archivo =$real;
        $asistencia->grabacion = $request->grabacion;
        $asistencia->tarea= $request->tarea;

        $asistencia->save();


        $bitacora = new Bitacora;
        $bitacora->user_id = Auth::id();
        $consulta = User::where('id',Auth::id())->select("nombres","apellidos","rolprimario","rolsecundario")->get();
        foreach($consulta as $item){
            $nombres = $item->nombres;
            $apellidos = $item->apellidos;
            $rolprimario = $item->rolprimario;
            $rolsecundario = $item->rolsecundario;
        }
        
        $bitacora->usuario = $nombres." ".$apellidos;
        $bitacora->rol = $rolprimario.", ".$rolsecundario;
        $bitacora->fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $bitacora->hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $bitacora->accion = "Actualizada asistencia de clase";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

       // return response()->json($datosDepartamento);
       return redirect('asistencia');
    }

    
}
