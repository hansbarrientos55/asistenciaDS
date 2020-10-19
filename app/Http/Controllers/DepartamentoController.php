<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\Facultad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['departamentos']=Departamento::paginate(20);
        return view('departamento.index', $datos);
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
        //$datosDepartamento=request()->all();

        $datosDepartamento=request()->except('_token');
        Departamento::insert($datosDepartamento);

       // return response()->json($datosDepartamento);
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
        $datosDepartamento=request()->except(['_token','_method']);
        Departamento::where('id','=',$id)->update($datosDepartamento);

        return redirect('departamento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Departamento::destroy($id);

        return redirect('departamento');
    }
}
