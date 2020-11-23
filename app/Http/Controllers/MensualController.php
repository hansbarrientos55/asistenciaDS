<?php

namespace App\Http\Controllers;

use App\Mensual;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Asistencia;

class MensualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistencias = Mensual::all();
        return view('mensual.index',compact('asistencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $usuarios = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->get();

        return view('mensual.create', compact('fecha', 'hora', 'usuarios'));

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

        $periodos = Asistencia::where('user_id',$request->user_id)->where('mes',$request->mes)->count();
        $horaclase = 1.5;
        $horas = $periodos*$horaclase;

        $asistencia = new Mensual;
        $asistencia->user_id = $request->user_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora = $request->hora;
        $asistencia->mes = $request->mes;
        $asistencia->vistobueno = $request->vistobueno;
        $asistencia->firma = $request->firma;
        $asistencia->horas = $horas;
        $asistencia->archivo =$real;

        $asistencia->save();

       // return response()->json($datosDepartamento);
       return redirect('mensual');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AsistenciaMensual  $asistenciaMensual
     * @return \Illuminate\Http\Response
     */
    public function show(Mensual $Mensual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AsistenciaMensual  $asistenciaMensual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asi = Mensual::findOrFail($id);
        $usuarios = User::where('rolprimario','Docente')->orWhere('rolsecundario','Docente')->get();

        return view('mensual.edit', compact('asi','usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AsistenciaMensual  $asistenciaMensual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosasistencia=request()->except(['_token','_method']);
        Mensual::where('id','=',$id)->update($datosasistencia);

        return redirect('mensual');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AsistenciaMensual  $asistenciaMensual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mensual::destroy($id);

        return redirect('mensual');
    }
}
