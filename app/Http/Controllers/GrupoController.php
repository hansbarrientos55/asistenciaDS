<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\Materia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $datos['grupos']=Grupo::paginate(20);
        return view('grupo.index', $grupos);
    }

    public function vergrupos($id){

        $grupos = Grupo::where('materia_id','=',$id)->get();
        return view('grupo.index',compact('grupos',"id"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grupo.create');
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
        $datosGrupo=request()->except('_token');
        Grupo::insert($datosGrupo);

       // return response()->json($datosDepartamento);
       //return redirect('grupo');
       return view('grupo.vergrupos');
    }

    public function almacenar(Request $request,$id)
    {
        $datosGrupo=request()->except('_token');
        $datosGrupo['materia_id'] = $id;
        Grupo::insert($datosGrupo);

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
        $materias = Materia::all();
        return view('grupo.edit', compact('gru','materias'));
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

        return redirect('grupo');
    }

    public function actualizargrupo(Request $request, $id)
    {
        $datosGrupo=request()->except(['_token','_method']);
        Grupo::where('id','=',$id)->update($datosGrupo);

        return redirect('/grupo/'.$id.'/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Grupo::destroy($id);

        return redirect('grupo');
    }

    public function eliminargrupo($id)
    {
        //$materia=Grupo::where("id","=",$id)->select("materia_id")->toString();
        Grupo::destroy($id);

        //return redirect('/grupo/'.$materia.'/index');
        return redirect('materia');
    }
}
