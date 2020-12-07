<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Departamento;
use App\User;
use App\Materia;
use App\Grupo;
use App\Horario;

use App\Asignacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;
use Carbon\Carbon;

class AsignacionController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->get();
        $asignaciones = Asignacion::all();
        return view('asignacion.index',compact('asignaciones','docentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gestiones = Gestion::all();
        $departamentos = Departamento::all();
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->get();
        $materias = Materia::all()->pluck("nombremate","id");
        return view('asignacion.create', compact('gestiones','departamentos', 'docentes', 'materias'));
    }

    public function getgroups($id) 
    {        
        $grupos = Grupo::where("materia_id",$id)->pluck("numerogrupo","id");
        return json_encode($grupos);
    }

    public function gethorarios($id){
        $horarios = Horario::where("grupo_id",$id)->pluck("titulo","id");
        return json_encode($horarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return view('crud');
        //return $request->all();
        $asignacion = new Asignacion;
        $asignacion->gestion = $request->gestion;
        $asignacion->departamento = $request->departamento;
        $asignacion->docente = $request->docente;
        $asignacion->materia = $request->materia;
        $asignacion->grupo = $request->grupo;

        $asignacion->save();
        //$asignaciones = Asignacion::all();
        //return view('asignacion.index',compact('asignaciones'));

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
        $bitacora->accion = "Registrada asignacion de materia-grupo-horario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('asignacion');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asi = Asignacion::findOrFail($id);
        $gestiones = Gestion::all();
        $departamentos = Departamento::all();
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->get();
        $materias = Materia::all()->pluck("nombremate","id");

        return view('asignacion.edit', compact('asi','gestiones','departamentos', 'docentes', 'materias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosAsignacion=request()->except(['_token','_method']);
        Asignacion::where('id','=',$id)->update($datosAsignacion);

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
        $bitacora->accion = "Editada asignacion de materia-grupo-horario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('asignacion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asignacion::destroy($id);

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
        $bitacora->accion = "Eliminada asignacion de materia-grupo-horario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('asignacion');
    }
}
