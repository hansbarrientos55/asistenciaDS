@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Gestiones</h1>

<a href="{{url('gestion/create')}}" class="btn btn-success">Agregar gestion</a>


<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th>Id </th>
            <th>Periodo</th>
            <th>Año</th>
            <th>Gestion</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($gestiones as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->periodogestion}}</td>
                <td>{{$item->añogestion}}</td>
                <td>{{$item->gestion}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a class="btn btn-warning" href="{{ url('/gestion/'.$item->id.'/edit') }}">Editar</a>
                    
                @if($item->estaactivo == 'Activo')
                <form action="{{ url('/gestion/disable/'.$item->id) }}" style="display:inline" method="post">
                     {{ csrf_field() }}   
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Se archivara el registro.');" >Archivar</button>
                </form>
                @endif

                @if($item->estaactivo == 'Archivado')
                <form action="{{ url('/gestion/enable/'.$item->id) }}" style="display:inline" method="post">
                    {{ csrf_field() }}   
                   <button class="btn btn-info" type="submit" onclick="return confirm('Se desarchivara el registro. ');" >Desarchivar</button>
               </form>
               @endif


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

</div>
@endsection