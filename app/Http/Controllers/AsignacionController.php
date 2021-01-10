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
use App\Rules\AsignacionSinRepetir;
use App\Rules\AsignacionActualizar;

class AsignacionController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->where('estaactivo','Activo')->get();
        $asignaciones = Asignacion::all();
        return view('asignacion.index',compact('asignaciones','docentes'));
    }

    public function asignaciones()
    {
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->where('estaactivo','Activo')->get();
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
        $gestiones = Gestion::where('estaactivo','Activo')->get();
        $departamentos = Departamento::where('estaactivo','Activo')->get();
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->where('estaactivo','Activo')->get();
        $auxiliaresdocencia = User::where('rolprimario','Auxiliar de Docencia')->orWhere('rolsecundario','Auxiliar de Docencia')->where('estaactivo','Activo')->get();
        $auxiliareslabo = User::where('rolprimario','Auxiliar de Laboratorio')->orWhere('rolsecundario','Auxiliar de Laboratorio')->where('estaactivo','Activo')->get();
        $materias = Materia::where('estaactivo','Activo')->get();
        return view('asignacion.create', compact('gestiones','departamentos', 'docentes', 'auxiliaresdocencia','auxiliareslabo' , 'materias'));
    }

    public function grupo(Request $request){

        //dd($request);
        $gestion = $request["gestion"];
        $departamento = $request["departamento"];
        $docente = $request["docente"];
        $nombres = User::where('id',$docente)->where('estaactivo','Activo')->select("nombres")->value("nombres");
        $apellidos = User::where('id',$docente)->where('estaactivo','Activo')->select("apellidos")->value("apellidos");
        $nomdocente = $nombres." ".$apellidos;
        
        $auxiliardocencia = $request["auxiliardocencia"];
        $nomaux = User::where('id',$auxiliardocencia)->where('estaactivo','Activo')->select("nombres")->value("nombres");
        $apeaux = User::where('id',$auxiliardocencia)->where('estaactivo','Activo')->select("apellidos")->value("apellidos");
        $nomauxdocencia = $nomaux." ".$apeaux;

        $auxiliarlabo = $request["auxiliarlabo"];
        $nomlabo = User::where('id',$auxiliarlabo)->where('estaactivo','Activo')->select("nombres")->value("nombres");
        $apelabo = User::where('id',$auxiliarlabo)->where('estaactivo','Activo')->select("apellidos")->value("apellidos");
        $nomauxlabo = $nomlabo." ".$apelabo;
        
        $materia = $request["materia"];
        $nommateria = Materia::where('id',$materia)->where('estaactivo','Activo')->select("nombremate")->value("nombremate");
        
        $grupos = Grupo::where("materia_id", $materia)->get();

        return view('asignacion.group', compact('gestion','departamento', 'docente', 'nomdocente', 'auxiliardocencia', 'nomauxdocencia', 'auxiliarlabo', 'nomauxlabo', 'materia', 'nommateria', 'grupos'));
    }

    public function guardar(Request $request){

        $ges = $request['gestion'];
        $mat = $request['materia'];
        $gru = $request['grupo'];
        $doc = $request['docente'];
        
        $request['etiqueta'] = $ges.'-'.$mat.'-'.$gru.'-'.$doc;


        $this->validate($request, ['etiqueta' => ['required', new AsignacionSinRepetir($ges,$mat,$gru,$doc)]]);
        

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
        $asignacion->numgrupo = Grupo::where('id',$request->grupo)->value('numerogrupo');

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
        //
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
        //    
    }

    public function editar($id)
    {
        $asi = Asignacion::findOrFail($id);
        //$llave = $asi->value("id");
        $llave = $id;
        $gestiones = Gestion::where('estaactivo','Activo')->get();
        $departamentos = Departamento::where('estaactivo','Activo')->get();
        $docentes = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->where('estaactivo','Activo')->get();
        $auxiliaresdocencia = User::where('rolprimario','Auxiliar de Docencia')->orWhere('rolsecundario','Auxiliar de Docencia')->where('estaactivo','Activo')->get();
        $auxiliareslabo = User::where('rolprimario','Auxiliar de Laboratorio')->orWhere('rolsecundario','Auxiliar de Laboratorio')->where('estaactivo','Activo')->get();
        $materias = Materia::where('estaactivo','Activo')->get();

        //dd($llave);

        return view('asignacion.edit', compact('asi','llave','gestiones','departamentos', 'docentes', 'auxiliaresdocencia','auxiliareslabo', 'materias'));
    }

    public function editargrupo(Request $request){

        //dd($request);
        $llave = $request["llave"];
        $gestion = $request["gestion"];
        $departamento = $request["departamento"];
        $docente = $request["docente"];
        $nombres = User::where('id',$docente)->where('estaactivo','Activo')->select("nombres")->value("nombres");
        $apellidos = User::where('id',$docente)->where('estaactivo','Activo')->select("apellidos")->value("apellidos");
        $nomdocente = $nombres." ".$apellidos;

        $auxiliardocencia = $request["auxiliardocencia"];
        $nomaux = User::where('id',$auxiliardocencia)->where('estaactivo','Activo')->select("nombres")->value("nombres");
        $apeaux = User::where('id',$auxiliardocencia)->where('estaactivo','Activo')->select("apellidos")->value("apellidos");
        $nomauxdocencia = $nomaux." ".$apeaux;

        $auxiliarlabo = $request["auxiliarlabo"];
        $nomlabo = User::where('id',$auxiliarlabo)->where('estaactivo','Activo')->select("nombres")->value("nombres");
        $apelabo = User::where('id',$auxiliarlabo)->where('estaactivo','Activo')->select("apellidos")->value("apellidos");
        $nomauxlabo = $nomlabo." ".$apelabo;

        $materia = $request["materia"];
        $nommateria = Materia::where('id',$materia)->where('estaactivo','Activo')->select("nombremate")->value("nombremate");
        $grupos = Grupo::where("materia_id", $materia)->where('estaactivo','Activo')->get();

        return view('asignacion.editgroup', compact('llave', 'gestion','departamento', 'docente', 'nomdocente', 'auxiliardocencia', 'nomauxdocencia', 'auxiliarlabo', 'nomauxlabo', 'materia', 'nommateria', 'grupos'));
    }

    public function actualizar(Request $request, $id){

        //$datosAsignacion=request()->except(['_token','_method']);
        //Asignacion::where('id','=',$id)->update($datosAsignacion);
        
        $ges = $request['gestion'];
        $mat = $request['materia'];
        $gru = $request['grupo'];
        $doc = $request['docente'];
        $lla = $request['llave'];
        
        $request['etiqueta'] = $ges.'-'.$mat.'-'.$gru.'-'.$doc;

        //dd($request,$id);

        $this->validate($request, ['etiqueta' => ['required', new AsignacionActualizar($ges,$mat,$gru,$doc,$lla)]]);
        



        $asignacion = Asignacion::findOrFail($id);
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
        $asignacion->numgrupo = Grupo::where('id',$request->grupo)->value('numerogrupo');

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
    public function eliminar(Request $request, $id)
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
