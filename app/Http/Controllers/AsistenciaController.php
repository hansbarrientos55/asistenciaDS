<?php

namespace App\Http\Controllers;


use App\Asistencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Materia;
use App\Grupo;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistencias = Asistencia::all();
        return view('asistencia.index',compact('asistencias'));
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
        $mes = Carbon::now()->format('F');
        $month = Carbon::now()->startOfWeek()->format('m');
        $ini = Carbon::now()->startOfWeek()->format('d');
        $fin = Carbon::now()->endOfWeek()->format('d');
        $iniciosemana = $month.'/'.$ini;
        $finsemana = $month.'/'.$fin;
        $materias = Materia::all();
        $grupos = Grupo::all();
        return view('asistencia.create', compact('fecha', 'hora', 'mes','iniciosemana','finsemana', 'materias', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosAsistencia=request()->except('_token');
        Asistencia::insert($datosAsistencia);

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
        return view('asistencia.edit', compact('asi','materias','grupos'));
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

        return redirect('asistencia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        asistencia::destroy($id);

        return redirect('asistencia');
    }
}
