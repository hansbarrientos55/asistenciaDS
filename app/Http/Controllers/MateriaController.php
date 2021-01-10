<?php

namespace App\Http\Controllers;

use App\Materia;
use App\Departamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Grupo;
use App\Horario;
use App\Asignacion;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias=Materia::all();
        return view('materia.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::where('estaactivo','Activo')->get();
        return view('materia.create', compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = [
            'codigomate' => 'unique:materias,codigomate',
            'nombremate' => 'unique:materias,nombremate',
            'descripcionmate' => 'unique:materias,descripcionmate',
        ];

        $mensaje =[
            'codigomate.unique' => 'Este codigo ya existe',
            'nombremate.unique' => 'Esta materia ya existe',
            'descripcionmate.unique' => 'Esta descripcion ya existe',
        ];

        $this->validate($request,$datos,$mensaje);

        //$datosMateria=request()->except('_token');
        //Materia::insert($datosMateria);
        
        $datos = new Materia;
        $datos->codigomate = $request->codigomate;
        $datos->nombremate = $request->nombremate;
        $datos->descripcionmate = $request->descripcionmate;
        $datos->nivelmate = $request->nivelmate;
        $datos->estaactivo = $request->estaactivo;
        $datos->departamento_id = $request->departamento_id;
        $datos->departamento_nombre = Departamento::where('id',$request->departamento_id)->value('nombredepa');
        $datos->save();

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
        $bitacora->accion = "Registrada materia";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

       // return response()->json($datosDepartamento);
       return redirect('materia');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mate = Materia::findOrFail($id);
        $departamentos = Departamento::where('estaactivo','Activo')->get();

        return view('materia.edit', compact('mate','departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $datos = [
            'codigomate' => 'unique:materias,codigomate,'.$id,
            'nombremate' => 'unique:materias,nombremate,'.$id,
            'descripcionmate' => 'unique:materias,descripcionmate,'.$id,
        ];

        $mensaje =[
            'codigomate.unique' => 'Este codigo ya existe',
            'nombremate.unique' => 'Esta materia ya existe',
            'descripcionmate.unique' => 'Esta descripcion ya existe',
        ];

        $this->validate($request,$datos,$mensaje);
        
        //$datosMateria=request()->except(['_token','_method']);
        //Materia::where('id','=',$id)->update($datosMateria);

        $datos = Materia::findOrFail($id);
        $datos->codigomate = $request->codigomate;
        $datos->nombremate = $request->nombremate;
        $datos->descripcionmate = $request->descripcionmate;
        $datos->nivelmate = $request->nivelmate;
        $datos->estaactivo = $request->estaactivo;
        $datos->departamento_id = $request->departamento_id;
        $datos->departamento_nombre = Departamento::where('id',$request->departamento_id)->value('nombredepa');
        $datos->save();

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
        $bitacora->accion = "Editada materia";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('materia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, $id)
    {
        //Materia::destroy($id);
        $materia = Materia::findOrFail($id);
        $materia->estaactivo = 'Archivado';
        $materia->save();

        $grupos = Grupo::where('materia_id',$id)->get();
        foreach($grupos as $item){
            $cod = $item->id;
            Grupo::destroy($cod);
            $horarios = Horario::where('grupo_id',$cod)->get();
            foreach($horarios as $ele){
                $moh = $ele->id;
                Horario::destroy($moh);
            }
        }

        $asignaciones = Asignacion::where('materia',$id)->get();
        foreach($asignaciones as $item){
            $ind = $item->id;
            $asigna = Asignacion::findOrFail($ind);
            $asigna->materia = 0;
            $asigna->nommateria = '-Ninguna-';
            $asigna->save();
        }

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
        $bitacora->accion = "Materia archivada";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('materia');
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
