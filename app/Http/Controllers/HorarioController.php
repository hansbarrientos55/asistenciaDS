<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Grupo;
use App\Hora;
use App\Dia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\User;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function verhorarios($id){

        $aux = Grupo::findOrFail($id);
        $mat = $aux['materia_id'];

        $horarios = Horario::where('grupo_id','=',$id)->get();
        return view('horario.index',compact('horarios','id','mat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function crearhorario($id)
    {
        $horas = Hora::all();
        $dias = Dia::all();
        return view('horario.create', compact('id','horas','dias'));
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

    public function almacenar(Request $request,$id)
    {
        
        $horario = new Horario;
        $horario->hora = $request->hora;
        $horario->dia = $request->dia;
        $horario->titulo = $request->dia." ".$request->hora;
        $horario->grupo_id = $id; 
        
        $horario->save();

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
        $bitacora->accion = "Registrado horario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();
        
        //$datosHorario=request()->except('_token');
        //$datosHorario['grupo_id'] = $id;
        //Horario::insert($datosHorario);

        return redirect('/horario/'.$id.'/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        //
    }

    public function editarhorario($id)
    {
        //$ho = Horario::findOrFail($id);
        $horas = Hora::all();
        $dias = Dia::all();
        return view('horario.edit', compact("id",'horas','dias'));
        //return view('horario.edit', compact('ho',"id"));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    public function actualizarhorario(Request $request, $id)
    {
        $datosHorario=request()->except(['_token','_method']);
        $datosHorario['titulo'] = $datosHorario['dia']." ".$datosHorario['hora'];
        Horario::where('id','=',$id)->update($datosHorario);
        $ox = Horario::findOrFail($id);
        $gro = $ox['grupo_id'];

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
        $bitacora->accion = "Editado horario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        //return redirect('/horario/'.$id.'/index');
        return redirect('/horario/'.$gro.'/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        //
    }

    public function eliminarhorario($id)
    {
        //$materia=Grupo::where("id","=",$id)->select("materia_id")->toString();
        $ox = Horario::findOrFail($id);
        $gro = $ox['grupo_id'];
        
        Horario::destroy($id);

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
        $bitacora->accion = "Eliminado horario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('/horario/'.$gro.'/index');
        //return redirect('/grupo/'.$materia.'/index');
        //return redirect('materia');
    }
}
