<?php

namespace App\Http\Controllers;

use App\Ausencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hora;
use Carbon\Carbon;
use Auth;
use App\Bitacora;
use App\User;

class AusenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$ausencias = Ausencia::all();
        $ausencias = Ausencia::where('user_id',Auth::id())->get();
        return view('ausencia.index',compact('ausencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fecha = Carbon::now()->toDateString();
        $hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $horas = Hora::all();

        return view('ausencia.create', compact('fecha','hora','horas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('archivo') == null) {
            $real = "";
        }else{
           $real = $request->file('archivo')->store('public');  
        }
        
        $ausencia = new Ausencia;
        $ausencia->user_id = Auth::id();
        $ausencia->fecha = $request->fecha;
        $ausencia->hora = $request->hora;
        $ausencia->motivo = $request->motivo;
        $ausencia->fechaausencia = $request->fechaausencia;
        $ausencia->horaausencia = $request->horaausencia;
        $ausencia->archivo =$real;

        $ausencia->save();

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
        $bitacora->accion = "Registrada ausencia a una clase";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('ausencia');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ausencia  $ausencia
     * @return \Illuminate\Http\Response
     */
    public function show(Ausencia $ausencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ausencia  $ausencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ause = Ausencia::findOrFail($id);
        $horas = Hora::all();
        return view('ausencia.edit', compact('ause','horas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ausencia  $ausencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosAusencia=request()->except(['_token','_method']);
        Ausencia::where('id','=',$id)->update($datosAusencia);

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

        return redirect('ausencia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ausencia  $ausencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Ausencia::destroy($id);

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
        $bitacora->accion = "Eliminada ausencia a una clase";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('ausencia');
    }

    public function list()
    {
        $ausencias = Ausencia::all();
        return view('ausencia.list',compact('ausencias'));
    }

    public function editarlista($id)
    {
        $ause = Ausencia::findOrFail($id);
        $horas = Hora::all();
        return view('ausencia.listedit', compact('ause','horas'));
    }

    public function actualizarlista(Request $request, $id)
    {
        $datosAusencia=request()->except(['_token','_method']);
        Ausencia::where('id','=',$id)->update($datosAusencia);

        $ausencias = Ausencia::all();

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
        $bitacora->accion = "Editada lista de ausencias";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        //return view('ausencia.list',compact('ausencias'));
        return redirect('/ausencialista/');

    }
}
