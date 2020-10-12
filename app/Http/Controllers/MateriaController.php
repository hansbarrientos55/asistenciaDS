<?php

namespace App\Http\Controllers;

use App\Materia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['materias']=Materia::paginate(20);
        return view('materia.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materia.create');
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

        $datosMateria=request()->except('_token');
        Materia::insert($datosMateria);

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

        return view('materia.edit', compact('mate'));
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
        $datosMateria=request()->except(['_token','_method']);
        Materia::where('id','=',$id)->update($datosMateria);

        return redirect('materia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Materia::destroy($id);

        return redirect('materia');
    }
}
