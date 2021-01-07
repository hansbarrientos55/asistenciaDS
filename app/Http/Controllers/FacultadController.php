<?php

namespace App\Http\Controllers;

use App\Facultad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Validation\Rule;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['facultades']=Facultad::paginate(20);
        return view('facultad.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facultad.create');
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
            'nombrefacu' => 'unique:facultads,nombrefacu',
            'descripcionfacu' => 'unique:facultads,descripcionfacu',
        ];

        $mensaje =[
            'nombrefacu.unique' => 'Esta facultad ya existe',
            'descripcionfacu.unique' => 'Esta descripcion ya existe',
        ];

        $this->validate($request,$datos,$mensaje);



        $datosFacultad=request()->except('_token');
        Facultad::insert($datosFacultad);

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
       $bitacora->accion = "Registrada facultad";
       $bitacora->direccion_ip = $request->getClientIp();
       $bitacora->save();

       return redirect('facultad');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function show(Facultad $facultad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facu = Facultad::findOrFail($id);

        return view('facultad.edit', compact('facu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $datos = [
            'nombrefacu' => 'unique:facultads,nombrefacu,'.$id,
            'descripcionfacu' => 'unique:facultads,descripcionfacu,'.$id,
        ];

        $mensaje =[
            'nombrefacu.unique' => 'Esta facultad ya existe',
            'descripcionfacu.unique' => 'Esta descripcion ya existe',
        ];

        $this->validate($request,$datos,$mensaje);
        
        
        $datosFacultad=request()->except(['_token','_method']);
        Facultad::where('id','=',$id)->update($datosFacultad);

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
        $bitacora->accion = "Editada facultad";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('facultad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Facultad::destroy($id);

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
        $bitacora->accion = "Eliminada facultad";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('facultad');
    }
}
