<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['users']=User::paginate(20);
        return view('user.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
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

         $datosUsuario=request()->except('_token');
         $datosUsuario['password']= Hash::make($request['contrasenia']);

         $auxRolPrimario = Role::findOrFail($request['rolprimario']); 
         $datosUsuario['rolprimariotexto']= $auxRolPrimario['titulo'];
         $auxRolSecundario = Role::findOrFail($request['rolsecundario']);
         $datosUsuario['rolsecundariotexto']= $auxRolSecundario['titulo'];

         User::insert($datosUsuario);
 
        // return response()->json($datosDepartamento);
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usu = User::findOrFail($id);
        $roles = Role::all();

        return view('user.edit', compact('usu','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosUsuario=request()->except(['_token','_method']);
        $datosUsuario['password']= Hash::make($request['contrasenia']);

        $auxRolPrimario = Role::findOrFail($request['rolprimario']); 
        $datosUsuario['rolprimariotexto']= $auxRolPrimario['titulo'];
        $auxRolSecundario = Role::findOrFail($request['rolsecundario']);
        $datosUsuario['rolsecundariotexto']= $auxRolSecundario['titulo'];

        User::where('id','=',$id)->update($datosUsuario);

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('user');
    }

    public function importar(){

        return view('user/import');
    }

    public function guardar(Request $request){

        $import = new UserImport();
        Excel::import($import, request()->file('users'));
        return view('user/import', ['numRows'=>$import->getRowCount()]);
    
    }
}
