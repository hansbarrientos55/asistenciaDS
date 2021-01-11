<?php

namespace App\Http\Controllers;

use App\Reposicion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Materia;
use App\Grupo;
use App\Hora;
use Auth;
use App\Bitacora;
use App\User;
use App\Rules\ReposicionSinRepetir;
use App\Rules\ReposicionActualizar;
use App\Rules\AusenciaFecha;

class ReposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //
    }

    public function ver($id)
    {
        $reposicion = Reposicion::where('ausencia_id','=',$id)->get();
        return view('reposicion.index',compact('reposicion','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function crear($id)
    {
        $fecha = Carbon::now()->setTimezone('America/Caracas')->toDateString();
        $hora = Carbon::now()->setTimezone('America/Caracas')->toTimeString();
        $materias = Materia::all();
        $grupos = Grupo::all();
        $horarios = Hora::all();
        $usuario = Auth::id();
        return view('reposicion.create', compact('id', 'fecha', 'hora', 'materias', 'grupos', 'horarios', 'usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function almacenar(Request $request,$id)
    {
        $ausencia = $id;
        $fecha = $request['nuevafecha'];
        $hora = $request['horario'];
        
        $this->validate($request, [
                                    'estado' => ['required', new ReposicionSinRepetir($ausencia,$fecha,$hora)],
                                    'nuevafecha' => ['required', new AusenciaFecha()], 
                                  ]
                        
                       );
        
        $datosRepo=request()->except('_token');
        $datosRepo['ausencia_id'] = $id;
        reposicion::insert($datosRepo);

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
        $bitacora->accion = "Registrada reposicion";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

       // return response()->json($datosDepartamento);
       //return redirect('grupo');
       return redirect('/reposicion/'.$id.'/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reposicion  $reposicion
     * @return \Illuminate\Http\Response
     */
    public function show(Reposicion $reposicion)
    {
        //  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reposicion  $reposicion
     * @return \Illuminate\Http\Response
     */
    public function edit(Reposicion $reposicion)
    {
        //
    }

    public function editar($id)
    {
        $repo = Reposicion::findOrFail($id);
        $materias = Materia::all();
        $grupos = Grupo::all();
        $horarios = Hora::all();
        return view('reposicion.edit', compact('repo','id','materias','grupos','horarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reposicion  $reposicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reposicion $reposicion)
    {
        //
    }

    public function actualizar(Request $request, $id)
    {
        $repo = Reposicion::findOrFail($id);
        
        $ausencia = $repo['ausencia_id'];
        $fecha = $request['nuevafecha'];
        $hora = $request['horario'];
        $repo = $id;
        
        $this->validate($request, [
                                    'estado' => ['required', new ReposicionActualizar($ausencia,$fecha,$hora,$repo)],
                                    'nuevafecha' => ['required', new AusenciaFecha()], 
                                  ]
                        
                       );
        
        
        $datosRepo=request()->except(['_token','_method']);
        Reposicion::where('id','=',$id)->update($datosRepo);
        $aux = Reposicion::findOrFail($id);
        $mat = $aux['ausencia_id'];

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
        $bitacora->accion = "Editada reposicion";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('/reposicion/'.$mat.'/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reposicion  $reposicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reposicion $reposicion)
    {
        //
    }

    public function eliminar(Request $request, $id)
    {
        //$materia=Grupo::where("id","=",$id)->select("materia_id")->toString();
        $aux = Reposicion::findOrFail($id);
        $mat = $aux['ausencia_id'];

        Reposicion::destroy($id);


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
        $bitacora->accion = "Eliminada reposicion";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('/reposicion/'.$mat.'/index');
        //return redirect('/grupo/'.$materia.'/index');
       // return redirect('materia');
    }

    public function list()
    {
        $reposiciones = Reposicion::all();
        return view('reposicion.list',compact('reposiciones'));
    }

    public function editarlista($id)
    {
        $repos = Reposicion::findOrFail($id);
        return view('reposicion.listedit', compact('repos'));
    }

    public function actualizarlista(Request $request, $id)
    {
        $datosReposicion=request()->except(['_token','_method']);
        Reposicion::where('id','=',$id)->update($datosReposicion);

        $reposiciones = Reposicion::all();

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
        $bitacora->accion = "Editada lista de reposiciones";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        //return view('ausencia.list',compact('ausencias'));
        return redirect('/reposicionlista/');

    }
}
