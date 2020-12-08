<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\Materia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\User;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$datos['grupos']=Grupo::paginate(20);
        //return view('grupo.index', $grupos);
    }

    public function vergrupos($id){

        $grupos = Grupo::where('materia_id','=',$id)->get();
        return view('grupo.index',compact('grupos','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('grupo.create');
    }

    public function creargrupo($id)
    {
        return view('grupo.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosGrupo=request()->except('_token');
        //Grupo::insert($datosGrupo);

       // return response()->json($datosDepartamento);
       //return redirect('grupo');

       //return view('grupo.vergrupos');
    }

    public function almacenar(Request $request,$id)
    {
        $datosGrupo=request()->except('_token');
        $datosGrupo['materia_id'] = $id;
        Grupo::insert($datosGrupo);

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
        $bitacora->accion = "Registrado grupo";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

       // return response()->json($datosDepartamento);
       //return redirect('grupo');
       return redirect('/grupo/'.$id.'/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gru = Grupo::findOrFail($id);
        return view('grupo.edit', compact('gru',"id"));
    }

    public function editargrupo($id)
    {
        $gru = Grupo::findOrFail($id);
        return view('grupo.edit', compact('gru',"id"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosGrupo=request()->except(['_token','_method']);
        Grupo::where('id','=',$id)->update($datosGrupo);

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
        $bitacora->accion = "Editado grupo";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('grupo');
    }

    public function actualizargrupo(Request $request, $id)
    {
        $datosGrupo=request()->except(['_token','_method']);
        Grupo::where('id','=',$id)->update($datosGrupo);
        $aux = Grupo::findOrFail($id);
        $mat = $aux['materia_id'];

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
        $bitacora->accion = "Editado grupo";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('/grupo/'.$mat.'/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Grupo::destroy($id);

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
        $bitacora->accion = "Eliminado grupo";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('grupo');
    }

    public function eliminargrupo(Request $request, $id)
    {
        //$materia=Grupo::where("id","=",$id)->select("materia_id")->toString();
        $aux = Grupo::findOrFail($id);
        $mat = $aux['materia_id'];

        Grupo::destroy($id);


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
        $bitacora->accion = "Eliminado grupo";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('/grupo/'.$mat.'/index');
        //return redirect('/grupo/'.$materia.'/index');
       // return redirect('materia');
    }
}
