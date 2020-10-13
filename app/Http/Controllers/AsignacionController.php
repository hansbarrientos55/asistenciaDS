<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Departamento;
use App\Docente;
use App\Materia;
use App\Grupo;

use App\Asignacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    
    
    public function asignacion(){
        $gestiones = Gestion::all();
        $departamentos = Departamento::all();
        $docentes = Docente::all();
        $materias = Materia::all();
        $grupos = Grupo::all();
        return view('asignacion.asignacion', compact('gestiones','departamentos', 'docentes', 'materias', 'grupos'));
    }

    public function pedido(Request $request){
        //return view('crud');
        //return $request->all();
        $asignacion = new Asignacion;
        $asignacion->gestion = $request->gestion;
        $asignacion->departamento = $request->departamento;
        $asignacion->docente = $request->docente;
        $asignacion->materia = $request->materia;
        $asignacion->grupo = $request->grupo;
        $asignacion->horario = $request->horario;

        $asignacion->save();
        $asignaciones = Asignacion::all();
        return view('asignacion.pedido',compact('asignaciones'));
    }

    public function listado(){
       
        $asignaciones = Asignacion::all();
        return view('asignacion.listado',compact('asignaciones'));

        //$asignaciones['asignacions']=Asignacion::paginate(20);
        //return view('asignacion.listado', $asignaciones);
    }
    
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignacion $asignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignacion $asignacion)
    {
        //
    }
}
