@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Horarios</h1>

<a href="{{url('horario/create/'.$id)}}" class="btn btn-success">Agregar horario</a>

<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th> Id </th>
            <th>Hora</th>
            <th>Dia</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($horarios as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->dia}}</td>
                <td> 
                
                <a class="btn btn-warning" href="{{ url('/horario/'.$item->id.'/edit') }}">Editar</a>
                    

                <form action="{{ url('/horario/delete/'.$item->id) }}" style="display:inline" method="post">
                     {{ csrf_field() }}   
                    
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
            
         @endforeach

        
    </tbody>
</table>

<a class="btn btn-dark" href="{{ url('/grupo/'.$mat.'/index') }}">Volver a grupo</a>

</div>
@endsection