<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Facultad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\User;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['carreras']=Carrera::paginate(20);
        return view('carrera.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultades = Facultad::all();
        return view('carrera.create', compact('facultades'));
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
            'codigocarrera' => 'unique:carreras,codigocarrera',
            'nombrecarrera' => 'unique:carreras,nombrecarrera',
            'descripcioncarrera' => 'unique:carreras,descripcioncarrera',
        ];

        $mensaje =[
            'codigocarrera.unique' => 'Este codigo ya existe',
            'nombrecarrera.unique' => 'Este nombre ya existe',
            'descripcioncarrera.unique' => 'Esta descripcion ya existe',
        ];

        $this->validate($request,$datos,$mensaje);
        
        
        $datos = new Carrera;
        $datos->codigocarrera = $request->codigocarrera;
        $datos->nombrecarrera = $request->nombrecarrera;
        $datos->descripcioncarrera = $request->descripcioncarrera;
        $datos->estaactivo = $request->estaactivo;
        $datos->facultad_id = $request->facultad_id;
        $datos->facultad_nombre = Facultad::where('id',$request->facultad_id)->value('nombrefacu');
        $datos->save();


        //$datosCarrera=request()->except('_token');
        //Carrera::insert($datosCarrera);



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
        $bitacora->accion = "Registrada carrera";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();
       
       return redirect('carrera');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carre = Carrera::findOrFail($id);
        $facultades = Facultad::all();

        return view('carrera.edit', compact('carre', 'facultades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $datos = [
            'codigocarrera' => 'unique:carreras,codigocarrera,'.$id,
            'nombrecarrera' => 'unique:carreras,nombrecarrera,'.$id,
            'descripcioncarrera' => 'unique:carreras,descripcioncarrera,'.$id,
        ];

        $mensaje =[
            'codigocarrera.unique' => 'Este codigo ya existe',
            'nombrecarrera.unique' => 'Este nombre ya existe',
            'descripcioncarrera.unique' => 'Esta descripcion ya existe',
        ];

        $this->validate($request,$datos,$mensaje);
        
        $datos = Carrera::findOrFail($id);
        $datos->codigocarrera = $request->codigocarrera;
        $datos->nombrecarrera = $request->nombrecarrera;
        $datos->descripcioncarrera = $request->descripcioncarrera;
        $datos->estaactivo = $request->estaactivo;
        $datos->facultad_id = $request->facultad_id;
        $datos->facultad_nombre = Facultad::where('id',$request->facultad_id)->value('nombrefacu');
        $datos->save();


        //$datosCarrera=request()->except(['_token','_method']);
        //Carrera::where('id','=',$id)->update($datosCarrera);

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
        $bitacora->accion = "Editada carrera";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('carrera');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Carrera::destroy($id);

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
        $bitacora->accion = "Eliminada carrera";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('carrera');
    }
}
