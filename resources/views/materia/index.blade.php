@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Administracion de Materias</h1>

<a href="{{url('materia/create')}}" class="btn btn-success">Agregar materia</a>


<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th>Id</th>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Nivel</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($materias as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombremate}}</td>
                <td>{{$item->codigomate}}</td>
                <td>{{$item->descripcionmate}}</td>
                <td>{{$item->nivelmate}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a class="btn btn-primary" href="{{ url('/grupo/'.$item->id.'/index') }}">Ver grupos</a>    
                <a class="btn btn-warning" href="{{ url('/materia/'.$item->id.'/edit') }}">Editar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/materia/'.$item->id) }}" style="display:inline" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

</div>
@endsection