<?php

namespace App\Http\Controllers;

use App\Rango;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RangoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['rangos']=Role::paginate(20);
        return view('rango.index', $datos);
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
        $datosRol=request()->except('_token');
       
        $role = Role::create(['name' => $datosRol['name']]);

        $role->givePermissionTo('acceso-al-sistema');

        foreach($datosRol as $key=>$val){

            if($key != 'name'){
                
                $role->givePermissionTo($key);
                
            } 
        }
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
        $role = Role::findOrFail($id);
        $antigua= $role->getAllPermissions();

        $datosRol=request()->except(['_token','_method']);
        //Role::where('id','=',$id)->update($datosRol);
        $role->name = $datosRol['name'];
        
        
        foreach($antigua as $item){

            $role->revokePermissionTo($item);

        }

        foreach($datosRol as $key=>$val){

            if($key != 'name'){
                
                $role->givePermissionTo($key);
                
            } 
        }

        $role->save();


        return redirect('rango');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);

        return redirect('rango');
    }
}
