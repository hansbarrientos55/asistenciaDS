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
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\CrearUsuarioRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['users']=User::where('id','!=',0)->paginate(60);
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

        $datos = [
            'cedula' => 'unique:users,cedula',
            'username' => 'unique:users,username',
            'emailprincipal' => 'unique:users,emailprincipal',
            'telefonoprincipal' => 'unique:users,telefonoprincipal',
        ];

        $mensaje =[
            'cedula.unique' => 'Esta cedula de identidad ya existe',
            'username.unique' => 'Este codigo SIS ya existe',
            'emailprincipal.unique' => 'Este email principal ya existe',
            'telefonoprincipal.unique' => 'Este telefono principal ya existe',
        ];

        $this->validate($request,$datos,$mensaje);

        

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
        $bitacora->accion = "Registrado usuario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();
 
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
        
        $datos = [
            'cedula' => 'unique:users,cedula,'.$id,
            'username' => 'unique:users,username,'.$id,
            'emailprincipal' => 'unique:users,emailprincipal,'.$id,
            'telefonoprincipal' => 'unique:users,telefonoprincipal,'.$id,
        ];

        $mensaje =[
            'cedula.unique' => 'Esta cedula de identidad ya existe',
            'username.unique' => 'Este codigo SIS ya existe',
            'emailprincipal.unique' => 'Este email principal ya existe',
            'telefonoprincipal.unique' => 'Este telefono principal ya existe',
        ];

        $this->validate($request,$datos,$mensaje);


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
        $bitacora->accion = "Editado usuario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        User::destroy($id);

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
        $bitacora->accion = "Eliminado usuario";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('user');
    }

    public function importar(){

        return view('user/import');
    }

    public function guardar(Request $request){

        $import = new UserImport();
        Excel::import($import, request()->file('users'));

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
        $bitacora->accion = "Importados usuarios de archivo externo";
        $bitacora->save();

        return view('user/import', ['numRows'=>$import->getRowCount()]);
    
    }
}
