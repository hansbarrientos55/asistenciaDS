@extends('layouts.principal')

@section('content')

<div class="container">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Administracion de Roles</h1>


@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif


<a href="{{url('role/create')}}" class="btn btn-success">Agregar rol</a>
<br>
<br>

<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th> Id </th>
            <th>Titulo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($roles as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->titulo}}</td>
                <td> 
                    
                <a class="btn btn-warning" href="{{ url('/role/'.$item->id.'/edit') }}">Editar</a>
                    
                

                <form action="{{ url('/role/'.$item->id) }}" style="display:inline" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Eliminar registro de rol? El cambio no se puede deshacer');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

</div>
@endsection

