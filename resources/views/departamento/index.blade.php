@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Departamentos</h1>

<a href="{{url('departamento/create')}}" class="btn btn-success">Agregar departamento</a>


<table class="table table-light table-hover" >
    <thead class="thead-light">
        <tr>

            <th>Id </th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($departamentos as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombredepa}}</td>
                <td>{{$item->descripciondepa}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a class="btn btn-warning" href="{{ url('/departamento/'.$item->id.'/edit') }}">Editar</a>
                

                <form action="{{ url('/departamento/'.$item->id) }}" style="display:inline" method="post">
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