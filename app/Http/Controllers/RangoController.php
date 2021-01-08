<?php

namespace App\Http\Controllers;

use App\Rango;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Bitacora;
use Auth;
use Carbon\Carbon;
use App\User;

class RangoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$datos['rangos']=Role::paginate(20);
        $rangos = Role::where('name','!=','-Ninguno-')->get();

        return view('rango.index', compact('rangos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permission::where('name','!=', 'acceso-al-sistema')->get();
        return view('rango.create', compact('permisos'));
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
            'name' => 'unique:roles,name',
        ];

        $mensaje =[
            'name.unique' => 'Este rol ya existe',
        ];

        $this->validate($request,$datos,$mensaje);

        
        $datosRol=request()->except('_token');
       
        $role = Role::create(['name' => $datosRol['name']]);

        $role->givePermissionTo('acceso-al-sistema');

        foreach($datosRol as $key=>$val){

            if($key != 'name'){
                
                $role->givePermissionTo($key);
                
            } 
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
        $bitacora->accion = "Registrado rol";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        //Role::insert($datosRol);

       // return response()->json($datosDepartamento);
       return redirect('rango');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Rango $rango)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ro = Role::findOrFail($id);
        //$antigua= $ro->getAllPermissions();
        $permisos = Permission::where('name','!=', 'acceso-al-sistema')->get();

        return view('rango.edit', compact('ro','permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = [
            'name' => 'unique:roles,name,'.$id,
        ];

        $mensaje =[
            'name.unique' => 'Este rol ya existe',
        ];

        $this->validate($request,$datos,$mensaje);

        
        $role = Role::findOrFail($id);
        $antigua= $role->getAllPermissions();

        $datosRol=request()->except(['_token','_method']);
        //Role::where('id','=',$id)->update($datosRol);
        $role->name = $datosRol['name'];
        
        
        foreach($antigua as $item){

            $role->revokePermissionTo($item);

        }

        $role->givePermissionTo('acceso-al-sistema');

        foreach($datosRol as $key=>$val){

            if($key != 'name'){
                
                $role->givePermissionTo($key);
                
            } 
        }

        $role->save();

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
        $bitacora->accion = "Editado rol";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();


        return redirect('rango');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $roleliminar = Role::findOrFail($id);

        $rolaux = Role::where('id',$id)->value('name');
        $usuarios = User::where('rolprimario',$rolaux)->orWhere('rolsecundario',$rolaux)->get();
        foreach($usuarios as $item){
            $ind = $item->id;
            $modificado = User::findOrFail($ind);
            if($modificado->rolprimario == $rolaux){
                $modificado->rolprimario = '-Ninguno-';
                $modificado->assignRole('-Ninguno-');
            }
            if($modificado->rolsecundario ==$rolaux){
                $modificado->rolsecundario = '-Ninguno';
                $modificado->assignRole('-Ninguno-');
                
            }
            $modificado->save();
            
        }
        
        $antiguos= $roleliminar->getAllPermissions();
        foreach($antiguos as $item){
            $roleliminar->revokePermissionTo($item);
        }

        Role::destroy($id);

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
        $bitacora->accion = "Eliminado rol";
        $bitacora->direccion_ip = $request->getClientIp();
        $bitacora->save();

        return redirect('rango');
    }
}
