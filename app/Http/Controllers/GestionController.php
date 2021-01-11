<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Asignacion;
use App\Rules\GestionSinRepetir;
use App\Rules\GestionActualizar;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestiones=Gestion::all();
        return view('gestion.index', compact('gestiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ahora = Carbon::now();
        $actual = Carbon::createFromFormat('Y-m-d H:i:s', $ahora)->year;
        $siguiente = $actual + 1;

        $anho = [
            "actual" => $actual,
            "siguiente" => $siguiente,
        ];

        return view('gestion.create', compact('anho'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['gestion'] = $request['periodogestion']."-".$request['añogestion'];

        $this->validate($request, ['gestion' => ['required', new GestionSinRepetir]]);
        
        $datosGestion=request()->except('_token');
        $datosGestion['gestion']=$datosGestion['periodogestion'].'-'.$datosGestion['añogestion'];
        Gestion::insert($datosGestion);

       // return response()->json($datosDepartamento);

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
        $bitacora->accion = "Registrada gestion";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

       return redirect('gestion');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function show(Gestion $gestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ges = Gestion::findOrFail($id);

        $ahora = Carbon::now();
        $actual = Carbon::createFromFormat('Y-m-d H:i:s', $ahora)->year;
        $siguiente = $actual + 1;

        $anho = [
            "actual" => $actual,
            "siguiente" => $siguiente,
        ];

        return view('gestion.edit', compact('ges','anho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['gestion'] = $request['periodogestion']."-".$request['añogestion'];

        //dd($request,$id);

        $this->validate($request, ['gestion' => ['required', new GestionActualizar($id)]]);
        
        $datosGestion=request()->except(['_token','_method']);
        $datosGestion['gestion']=$datosGestion['periodogestion'].'-'.$datosGestion['añogestion'];
        Gestion::where('id','=',$id)->update($datosGestion);

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
        $bitacora->accion = "Editada gestion";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('gestion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, $id)
    {
        $asignaciones = Asignacion::where('gestion',$id)->get();
        foreach($asignaciones as $item){
            $ind = $item->id;
            $asigna = Asignacion::findOrFail($ind);
            $asigna->gestion = '-Ninguna-';
            $asigna->save();
        }
        
        //Gestion::destroy($id);
        $gestion = Gestion::findOrFail($id);
        $gestion->estaactivo = 'Archivado';
        $gestion->save();

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
        $bitacora->accion = "Gestion archivada";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('gestion');
    }

    public function enable(Request $request, $id)
    {
        $asignaciones = Asignacion::where('gestion',$id)->get();
        foreach($asignaciones as $item){
            $ind = $item->id;
            $asigna = Asignacion::findOrFail($ind);
            $asigna->gestion = '-Ninguna-';
            $asigna->save();
        }
        
        //Gestion::destroy($id);
        $gestion = Gestion::findOrFail($id);
        $gestion->estaactivo = 'Activo';
        $gestion->save();

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
        $bitacora->accion = "Gestion activada";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('gestion');
    }
}
