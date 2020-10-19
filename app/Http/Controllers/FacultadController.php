<?php

namespace App\Http\Controllers;

use App\Facultad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        //$datosDepartamento=request()->all();

        $datosFacultad=request()->except('_token');
        Facultad::insert($datosFacultad);

       // return response()->json($datosDepartamento);
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
        $datosFacultad=request()->except(['_token','_method']);
        Facultad::where('id','=',$id)->update($datosFacultad);

        return redirect('facultad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Facultad::destroy($id);

        return redirect('facultad');
    }
}