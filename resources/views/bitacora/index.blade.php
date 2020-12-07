@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Registro de acciones</h1>

@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif



<br>
<br>

<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th> Id </th>
            <th>Id de Usuario</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Accion</th>
            <th>Direccion IP</th>
            
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($bitacoras as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->user_id}}</td>
                <td>{{$item->usuario}}</td>
                <td>{{$item->rol}}</td>
                <td>{{$item->fecha}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->accion}}</td>
                <td>{{$item->direccion_ip}}</td>
                
                <td> 
                    
                


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

</div>
@endsection

