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

    public function asignaciones()
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
    public function crear()
    {
        $gestiones = Gestion::all();
        $departamentos = Departamento::all();
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->get();
        $auxiliaresdocencia = User::where('rolprimario','Auxiliar de Docencia')->orWhere('rolsecundario','Auxiliar de Docencia')->get();
        $auxiliareslabo = User::where('rolprimario','Auxiliar de Laboratorio')->orWhere('rolsecundario','Auxiliar de Laboratorio')->get();
        $materias = Materia::all();
        return view('asignacion.create', compact('gestiones','departamentos', 'docentes', 'auxiliaresdocencia','auxiliareslabo' , 'materias'));
    }

    public function grupo(Request $request){

        //dd($request);
        $gestion = $request["gestion"];
        $departamento = $request["departamento"];
        $docente = $request["docente"];
        $nombres = User::where('id',$docente)->select("nombres")->value("nombres");
        $apellidos = User::where('id',$docente)->select("apellidos")->value("apellidos");
        $nomdocente = $nombres." ".$apellidos;
        
        $auxiliardocencia = $request["auxiliardocencia"];
        $nomaux = User::where('id',$auxiliardocencia)->select("nombres")->value("nombres");
        $apeaux = User::where('id',$auxiliardocencia)->select("apellidos")->value("apellidos");
        $nomauxdocencia = $nomaux." ".$apeaux;

        $auxiliarlabo = $request["auxiliarlabo"];
        $nomlabo = User::where('id',$auxiliarlabo)->select("nombres")->value("nombres");
        $apelabo = User::where('id',$auxiliarlabo)->select("apellidos")->value("apellidos");
        $nomauxlabo = $nomlabo." ".$apelabo;
        
        $materia = $request["materia"];
        $nommateria = Materia::where('id',$materia)->select("nombremate")->value("nombremate");
        $grupos = Grupo::where("materia_id", $materia)->get();

        return view('asignacion.group', compact('gestion','departamento', 'docente', 'nomdocente', 'auxiliardocencia', 'nomauxdocencia', 'auxiliarlabo', 'nomauxlabo', 'materia', 'nommateria', 'grupos'));
    }

    public function guardar(Request $request){

        $asignacion = new Asignacion;
        $asignacion->gestion = $request->gestion;
        $asignacion->departamento = $request->departamento;
        $asignacion->docente = $request->docente;
        $asignacion->nomdocente = $request->nomdocente;

        $asignacion->auxiliardocencia = $request->auxiliardocencia;
        $asignacion->nomauxdocencia = $request->nomauxdocencia;
        $asignacion->auxiliarlabo = $request->auxiliarlabo;
        $asignacion->nomauxlabo = $request->nomauxlabo;

        $asignacion->materia = $request->materia;
        $asignacion->nommateria = $request->nommateria;
        $asignacion->grupo = $request->grupo;

        $asignacion->save();



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

    public function editar($id)
    {
        $asi = Asignacion::findOrFail($id);
        $llave = $asi->value("id");
        $gestiones = Gestion::all();
        $departamentos = Departamento::all();
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->get();
        $auxiliaresdocencia = User::where('rolprimario','Auxiliar de Docencia')->orWhere('rolsecundario','Auxiliar de Docencia')->get();
        $auxiliareslabo = User::where('rolprimario','Auxiliar de Laboratorio')->orWhere('rolsecundario','Auxiliar de Laboratorio')->get();
        $materias = Materia::all();

        //dd($llave);

        return view('asignacion.edit', compact('asi','llave','gestiones','departamentos', 'docentes', 'auxiliaresdocencia','auxiliareslabo', 'materias'));
    }

    public function editargrupo(Request $request){

        //dd($request);
        $llave = $request["llave"];
        $gestion = $request["gestion"];
        $departamento = $request["departamento"];
        $docente = $request["docente"];
        $nombres = User::where('id',$docente)->select("nombres")->value("nombres");
        $apellidos = User::where('id',$docente)->select("apellidos")->value("apellidos");
        $nomdocente = $nombres." ".$apellidos;

        $auxiliardocencia = $request["auxiliardocencia"];
        $nomaux = User::where('id',$auxiliardocencia)->select("nombres")->value("nombres");
        $apeaux = User::where('id',$auxiliardocencia)->select("apellidos")->value("apellidos");
        $nomauxdocencia = $nomaux." ".$apeaux;

        $auxiliarlabo = $request["auxiliarlabo"];
        $nomlabo = User::where('id',$auxiliarlabo)->select("nombres")->value("nombres");
        $apelabo = User::where('id',$auxiliarlabo)->select("apellidos")->value("apellidos");
        $nomauxlabo = $nomlabo." ".$apelabo;

        $materia = $request["materia"];
        $nommateria = Materia::where('id',$materia)->select("nombremate")->value("nombremate");
        $grupos = Grupo::where("materia_id", $materia)->get();

        return view('asignacion.editgroup', compact('llave', 'gestion','departamento', 'docente', 'nomdocente', 'auxiliardocencia', 'nomauxdocencia', 'auxiliarlabo', 'nomauxlabo', 'materia', 'nommateria', 'grupos'));
    }

    public function actualizar(Request $request, $id){

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
        $bitacora->accion = "Registrada asignacion de materia-grupo-horario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('asignacion');

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
    public function destroy(Request $request, $id)
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
