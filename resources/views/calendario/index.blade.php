@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Calendario</h1>

@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif


<a href="{{url('calendario/create')}}" class="btn btn-success">Crear calendario</a>
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
        @foreach ($calendarios as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->dia}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->grupo}}</td>
                <td>{{$item->materia}}</td>
                <td>{{$item->clase}}</td>

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

