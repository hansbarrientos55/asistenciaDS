@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Administracion de Grupos</h1>

<a href="{{url('grupo/create/'.$id)}}" class="btn btn-success">Agregar grupo</a>


<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th>Id </th>
            <th>Numero</th>
            <th>Estado</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($grupos as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->numerogrupo}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                  
                <a class="btn btn-primary" href="{{ url('/horario/'.$item->id.'/index') }}">Ver horarios</a>    
                <a class="btn btn-warning" href="{{ url('/grupo/'.$item->id.'/edit') }}">Editar</a>
                    

                <form action="{{ url('/grupo/delete/'.$item->id) }}" style="display:inline" method="post">
                     {{ csrf_field() }}   
                     
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>
<a class="btn btn-dark" href="{{ url('materia') }}">Volver a materia</a>

</div>
@endsection