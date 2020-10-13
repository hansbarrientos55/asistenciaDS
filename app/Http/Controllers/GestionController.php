<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['gestiones']=Gestion::paginate(20);
        return view('gestion.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosGestion=request()->except('_token');
        Gestion::insert($datosGestion);

       // return response()->json($datosDepartamento);
       return redirect('gestion');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function show(Gestion $gestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ges = Gestion::findOrFail($id);

        return view('gestion.edit', compact('ges'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosGestion=request()->except(['_token','_method']);
        Gestion::where('id','=',$id)->update($datosGestion);

        return redirect('gestion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gestion::destroy($id);

        return redirect('gestion');
    }
}
