<?php

namespace App\Http\Controllers;

use App\Mensual;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Asistencia;
use App\Bitacora;
use Auth;
use App\Asignacion;
use App\Grupo;
use App\Horario;
use App\Ausencia;

use App\Rules\MensualSinRepetir;
use App\Rules\MensualActualizar;

use Barryvdh\DomPDF\Facade as PDF;

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
        $mes = $request['mes'];
        $usuario = $request['user_id'];
        //dd($request);
        $this->validate($request, ['vistobueno' => ['required', new MensualSinRepetir($mes,$usuario)]]);

        
        if ($request->file('archivo') == null) {
            $real = "";
        }else{
           $real = $request->file('archivo')->store('public');  
        }

        $contador=0;
        $horarios=0;
        $acumulador=0;

        $materias = Asignacion::where('docente',$request->user_id)->get();
        foreach($materias as $item){
            $grupos = Grupo::where('materia_id',$item->materia)->get();
            foreach($grupos as $gru){
                $horarios = Horario::where('grupo_id',$gru->id)->count();
                $contador = $contador + $horarios;
            }
            $acumulador = $acumulador + $contador;
            //dd($horarios,$contador,$acumulador);
        }

        $periodos = Asistencia::where('user_id',$request->user_id)->where('mes',$request->mes)->count();
        $horaclase = 1.5;
        $horas = $acumulador*$horaclase*4;
        $asistidas = $periodos*$horaclase;
        $faltas = $horas - $asistidas;

        $licencia = Ausencia::where('user_id',$request->user_id)->where('mes', $request->mes)->where('tipo', 'Licencia')->count();
        $licencias = $licencia * $horaclase;

        $baja = Ausencia::where('user_id',$request->user_id)->where('mes', $request->mes)->where('tipo', 'Baja')->count();
        $bajas = $baja * $horaclase;

        $comision = Ausencia::where('user_id',$request->user_id)->where('mes', $request->mes)->where('tipo','Comision')->count();
        $comisiones = $comision * $horaclase;

        $totalpagables = $asistidas+$licencias+$comisiones;

        $usuario = User::findOrFail($request->user_id);

        $asistencia = new Mensual;
        $asistencia->user_id = $request->user_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora = $request->hora;
        $asistencia->mes = $request->mes;
        $asistencia->usuario = $usuario->nombres.' '.$usuario->apellidos;
        
        $asistencia->horas = $horas;
        $asistencia->asistidas = $asistidas;
        $asistencia->faltas = $faltas;
        $asistencia->licencia = $licencias;
        $asistencia->baja = $bajas;
        $asistencia->comision = $comisiones;
        $asistencia->totalpagables = $totalpagables;

        $asistencia->vistobueno = $request->vistobueno;
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
        $bitacora->accion = "Registrada asistencia mensual";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

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
        //$datosasistencia=request()->except(['_token','_method']);
        //Mensual::where('id','=',$id)->update($datosasistencia);

        $mes = $request['mes'];
        $usuario = $request['user_id'];
        $registro = $id;
        //dd($request);
        $this->validate($request, ['vistobueno' => ['required', new MensualActualizar($mes,$usuario,$registro)]]);

        

        $contador=0;
        $horarios=0;
        $acumulador=0;

        $materias = Asignacion::where('docente',$request->user_id)->get();
        foreach($materias as $item){
            $grupos = Grupo::where('materia_id',$item->materia)->get();
            foreach($grupos as $gru){
                
                $horarios = Horario::where('grupo_id',$gru->id)->count();
                $contador = $contador + $horarios;
            }
            $acumulador = $acumulador + $contador;
            //dd($horarios,$contador,$acumulador);
        }
        $periodos = Asistencia::where('user_id',$request->user_id)->where('mes',$request->mes)->count();
        $horaclase = 1.5;
        $horas = $acumulador*$horaclase*4;
        $asistidas = $periodos*$horaclase;
        $faltas = $horas - $asistidas;

        $licencia = Ausencia::where('user_id',$request->user_id)->where('mes', $request->mes)->where('tipo', 'Licencia')->count();
        $licencias = $licencia * $horaclase;

        $baja = Ausencia::where('user_id',$request->user_id)->where('mes', $request->mes)->where('tipo', 'Baja')->count();
        $bajas = $baja * $horaclase;

        $comision = Ausencia::where('user_id',$request->user_id)->where('mes', $request->mes)->where('tipo','Comision')->count();
        $comisiones = $comision * $horaclase;
        $totalpagables = $asistidas+$licencias+$comisiones;

        $nombres = User::findOrFail($request->user_id);

        $asistencia = Mensual::findOrFail($id);
        $asistencia->user_id = $request->user_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora = $request->hora;
        $asistencia->mes = $request->mes;
        $asistencia->usuario = $nombres->nombres.' '.$nombres->apellidos;
        
        $asistencia->horas = $horas;
        $asistencia->asistidas = $asistidas;
        $asistencia->faltas = $faltas;
        $asistencia->licencia = $licencias;
        $asistencia->baja = $bajas;
        $asistencia->comision = $comisiones;
        $asistencia->totalpagables = $totalpagables;

        $asistencia->vistobueno = $request->vistobueno;
        $asistencia->firma = $request->firma;
        

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
        $bitacora->accion = "Editada asistencia mensual";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('mensual');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AsistenciaMensual  $asistenciaMensual
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        mensual::destroy($id);

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
        $bitacora->accion = "Eliminada asistencia mensual";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('mensual');
    }

    public function preparar()
    {
        $reportes = Mensual::all();

        $pagables=0;
        $nopagables=0;
        foreach($reportes as $item){
            $pagables = $pagables + $item->totalpagables;
            $nopagables = $nopagables + $item->faltas;
        }

        //dd($reportes);
        $pdf = PDF::loadView('mensual.impresion',compact('reportes','pagables','nopagables'));
        return $pdf->setPaper('a4', 'landscape')->stream('informe-mensual.pdf');

    }
}
