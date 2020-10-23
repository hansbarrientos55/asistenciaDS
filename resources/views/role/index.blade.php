@extends('layouts.funcion')

@section('content')

<div class="container">

<title>Administrar roles</title>

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

    <tbody>
        @foreach ($roles as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->titulo}}</td>
                <td> 
                    
                <a class="btn btn-warning" href="{{ url('/role/'.$item->id.'/edit') }}">Editar</a>
                    
                    
                    | Archivar | Desarchivar |

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

