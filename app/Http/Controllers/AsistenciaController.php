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

        $month = Carbon::now()->startOfWeek()->format('m');
        $ini = Carbon::now()->startOfWeek()->format('d');
        $fin = Carbon::now()->endOfWeek()->format('d');
        $iniciosemana = $month.'/'.$ini;
        $finsemana = $month.'/'.$fin;
        $materias = Materia::all();
        $grupos = Grupo::all();
        $horarios = Hora::all();
        return view('asistencia.create', compact('fecha', 'hora', 'mes','iniciosemana','finsemana', 'materias', 'grupos', 'horarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosAsistencia=request()->except('_token');
        //$usuario = Auth::id();
        //Asistencia::insert($datosAsistencia);

        if ($request->file('archivo') == null) {
            $real = "";
        }else{
           $real = $request->file('archivo')->store('public');  
        }

        $asistencia = new Asistencia;
        $asistencia->user_id = Auth::id();
        $asistencia->tipo = $request->tipo;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora = $request->hora;
        $asistencia->mes = $request->mes;
        $asistencia->iniciosemana = $request->iniciosemana;
        $asistencia->finsemana = $request->finsemana;
        $asistencia->horario = $request->horario;
        $asistencia->grupo = $request->grupo;
        $asistencia->materia = $request->materia;
        $asistencia->contenido = $request->contenido;
        $asistencia->repositorio = $request->repositorio;
        $asistencia->notificacion = $request->notificacion;
        $asistencia->claseonline = $request->claseonline;
        $asistencia->observaciones = $request->observaciones;
        $asistencia->firma = $request->firma;
        $asistencia->archivo =$real;

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
    public function destroy($id)
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

    
}
