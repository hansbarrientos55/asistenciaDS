<?php

namespace App\Http\Controllers;

use App\User;
use App\Rango;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['users']=User::paginate(60);
        return view('user.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$rangos = Rango::all();
        $roles = Role::all()->pluck('name', 'id');
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

         //$datosUsuario=request()->except('_token');
         //$datosUsuario['password']= Hash::make($request['contrasenia']);

         //$auxRolPrimario = Rango::findOrFail($request['rolprimario']); 
         //$datosUsuario['rolprimariotexto']= $auxRolPrimario['titulo'];
         //$auxRolSecundario = Rango::findOrFail($request['rolsecundario']);
         //$datosUsuario['rolsecundariotexto']= $auxRolSecundario['titulo'];

         //User::insert($datosUsuario);

         $usuario = new User;
         $usuario->nombres = $request->nombres;
         $usuario->apellidos = $request->apellidos;
         $usuario->cedula = $request->cedula;
         $usuario->fechanacimiento = $request->fechanacimiento;
         $usuario->direccion = $request->direccion;
         $usuario->profesion = $request->profesion;
         $usuario->username = $request->username;
         $usuario->contrasenia = $request->contrasenia;
         $usuario->password = Hash::make($request->contrasenia);
         $usuario->emailprincipal = $request->emailprincipal;
         $usuario->emailsecundario = $request->emailsecundario;
         $usuario->telefonoprincipal = $request->telefonoprincipal;
         $usuario->telefonosecundario = $request->telefonosecundario;
         $usuario->estaactivo = $request->estaactivo;
         $usuario->rolprimario = $request->rolprimario;
         $usuario->rolsecundario = $request->rolsecundario;
         if($usuario->save()){
            $usuario->assignRole($request->rolprimario);
            $usuario->assignRole($request->rolsecundario);
         }

         
 
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
        $roles = Role::all()->pluck('name', 'id');

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
        //$datosUsuario=request()->except(['_token','_method']);
        //$datosUsuario['password']= Hash::make($request['contrasenia']);

        //$auxRolPrimario = Rango::findOrFail($request['rolprimario']); 
        //$datosUsuario['rolprimariotexto']= $auxRolPrimario['titulo'];
        //$auxRolSecundario = Rango::findOrFail($request['rolsecundario']);
        //$datosUsuario['rolsecundariotexto']= $auxRolSecundario['titulo'];

        //User::where('id','=',$id)->update($datosUsuario);
        $usuario = User::findOrFail($id);
        $rolprimarioantiguo = $usuario->rolprimario;
        $rolsecundarioantiguo = $usuario->rolsecundario;

         $usuario->nombres = $request->nombres;
         $usuario->apellidos = $request->apellidos;
         $usuario->cedula = $request->cedula;
         $usuario->fechanacimiento = $request->fechanacimiento;
         $usuario->direccion = $request->direccion;
         $usuario->profesion = $request->profesion;
         $usuario->username = $request->username;
         $usuario->contrasenia = $request->contrasenia;
         $usuario->password = Hash::make($request->contrasenia);
         $usuario->emailprincipal = $request->emailprincipal;
         $usuario->emailsecundario = $request->emailsecundario;
         $usuario->telefonoprincipal = $request->telefonoprincipal;
         $usuario->telefonosecundario = $request->telefonosecundario;
         $usuario->estaactivo = $request->estaactivo;
         $usuario->rolprimario = $request->rolprimario;
         $usuario->rolsecundario = $request->rolsecundario;

            $usuario->removeRole($rolprimarioantiguo);
            $usuario->removeRole($rolsecundarioantiguo);
            $usuario->assignRole($request->rolprimario);
            $usuario->assignRole($request->rolsecundario);

            $usuario->save();

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
