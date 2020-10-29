@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Usuarios</h1>

@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif


<a href="{{url('user/create')}}" class="btn btn-success">Agregar usuario</a>
<a href="{{url('importar')}}" class="btn btn-primary">Agregar usuarios de archivo</a>
<br>
<br>

<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th> Id </th>
            <th>Usuario</th>
            <th>Cedula de identidad</th>
            <th>Fecha de nacimiento (Mes - Dia - Año)</th>
            <th>Direccion</th>
            <th>Profesion</th>
            <th>Codigo SIS</th>
            <th>Contraseña</th>
            <th>Rol primario</th>
            <th>Rol secundario</th>
            <th>Estado</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($users as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombres}} {{$item->apellidos}}</td>
                <td>{{$item->cedula}}</td>
                <td>{{$item->fechanacimiento}}</td>
                <td>{{$item->direccion}}</td>
                <td>{{$item->profesion}}</td>
                <td>{{$item->username}}</td>
                <td>{{$item->contrasenia}}</td>
                <td>{{$item->rolprimariotexto}}</td>
                <td>{{$item->rolsecundariotexto}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a class="btn btn-warning" href="{{ url('/user/'.$item->id.'/edit') }}">Editar</a>
                    

                <form action="{{ url('/user/'.$item->id) }}" style="display:inline" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Eliminar registro de usuario? El cambio no se puede deshacer');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

</div>
@endsection

