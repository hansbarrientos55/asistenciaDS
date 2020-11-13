<?php

namespace App\Http\Controllers;

use App\Ausencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hora;
use Carbon\Carbon;

class AusenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ausencias = Ausencia::all();
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
        $asignacion = new Ausencia;
        $asignacion->fecha = $request->fecha;
        $asignacion->hora = $request->hora;
        $asignacion->motivo = $request->motivo;
        $asignacion->fechaausencia = $request->fechaausencia;
        $asignacion->horaausencia = $request->horaausencia;

        $asignacion->save();
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

        return redirect('ausencia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ausencia  $ausencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ausencia::destroy($id);

        return redirect('ausencia');
    }
}
