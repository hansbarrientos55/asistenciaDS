<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\Facultad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Materia;
use App\Asignacion;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$datos['departamentos']=Departamento::paginate(20);
        $departamentos = Departamento::where('id','!=','0')->get();
        return view('departamento.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultades = Facultad::all();
        return view('departamento.create', compact('facultades'));
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
            'nombredepa' => 'unique:departamentos,nombredepa',
            'descripciondepa' => 'unique:departamentos,descripciondepa',
        ];

        $mensaje =[
            'nombredepa.unique' => 'Este departamento ya existe',
            'descripciondepa.unique' => 'Esta descripcion ya existe',
        ];

        $this->validate($request,$datos,$mensaje);
        


        $datos = new Departamento;
        $datos->nombredepa = $request->nombredepa;
        $datos->descripciondepa = $request->descripciondepa;
        $datos->estaactivo = $request->estaactivo;
        $datos->facultad_id = $request->facultad_id;
        $datos->facultad_nombre = Facultad::where('id',$request->facultad_id)->value('nombrefacu');
        $datos->save();

        //$datosDepartamento=request()->except('_token');
        //Departamento::insert($datosDepartamento);


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
       $bitacora->accion = "Creado departamento";
       $bitacora->direccion_ip = $request->getClientIp();
       $bitacora->save();


       return redirect('departamento');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depa = Departamento::findOrFail($id);
        $facultades = Facultad::all();

        return view('departamento.edit', compact('depa', 'facultades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = [
            'nombredepa' => 'unique:departamentos,nombredepa,'.$id,
            'descripciondepa' => 'unique:departamentos,descripciondepa,'.$id,
        ];

        $mensaje =[
            'nombredepa.unique' => 'Este departamento ya existe',
            'descripciondepa.unique' => 'Esta descripcion ya existe',
        ];

        $this->validate($request,$datos,$mensaje);
        
        
        $datos = Departamento::findOrFail($id);
        $datos->nombredepa = $request->nombredepa;
        $datos->descripciondepa = $request->descripciondepa;
        $datos->estaactivo = $request->estaactivo;
        $datos->facultad_id = $request->facultad_id;
        $datos->facultad_nombre = Facultad::where('id',$request->facultad_id)->value('nombrefacu');
        $datos->save();


        //$datosDepartamento=request()->except(['_token','_method']);
        //Departamento::where('id','=',$id)->update($datosDepartamento);

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
        $bitacora->accion = "Editado departamento";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('departamento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Departamento::destroy($id);

        $materias = Materia::where('departamento_id',$id)->get();
        foreach($materias as $item){
            $item->departamento_id = '0';
            $item->departamento_nombre = '-Ninguno-';
            $item->save();
        }

        $asignaciones = Asignacion::where('departamento',$id)->get();
        foreach($asignaciones as $item){
            $ind = $item->id;
            $asigna = Asignacion::findOrFail($ind);
            $asigna->departamento = '-Ninguno-';
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
        $bitacora->accion = "Eliminado departamento";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('departamento');
    }
}
