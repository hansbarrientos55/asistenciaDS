<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Grupo;
use App\Hora;
use App\Dia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HorarioController extends Controller
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

    public function verhorarios($id){

        $horarios = Horario::where('grupo_id','=',$id)->get();
        return view('horario.index',compact('horarios',"id"));
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

    public function crearhorario($id)
    {
        $horas = Hora::all();
        $dias = Dia::all();
        return view('horario.create', compact('id','horas','dias'));
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
        $datosHorario=request()->except('_token');
        $datosHorario['grupo_id'] = $id;
        Horario::insert($datosHorario);

       // return response()->json($datosDepartamento);
       //return redirect('grupo');
       return redirect('/horario/'.$id.'/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        //
    }

    public function editarhorario($id)
    {
        //$ho = Horario::findOrFail($id);
        $horas = Hora::all();
        $dias = Dia::all();
        return view('horario.edit', compact("id",'horas','dias'));
        //return view('horario.edit', compact('ho',"id"));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    public function actualizarhorario(Request $request, $id)
    {
        $datosHorario=request()->except(['_token','_method']);
        Horario::where('id','=',$id)->update($datosHorario);

        //return redirect('/horario/'.$id.'/index');
        return redirect('/grupo/'.$id.'/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        //
    }

    public function eliminarhorario($id)
    {
        //$materia=Grupo::where("id","=",$id)->select("materia_id")->toString();
        Horario::destroy($id);

        //return redirect('/grupo/'.$materia.'/index');
        return redirect('materia');
    }
}
