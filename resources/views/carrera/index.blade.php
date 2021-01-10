@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Carreras</h1>

<a href="{{url('carrera/create')}}" class="btn btn-success">Agregar carrera</a>


<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th>Id </th>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Facultad</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($carreras as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombrecarrera}}</td>
                <td>{{$item->codigocarrera}}</td>
                <td>{{$item->descripcioncarrera}}</td>
                <td>{{$item->facultad_nombre}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a class="btn btn-warning" href="{{ url('/carrera/'.$item->id.'/edit') }}">Editar</a>
                    
                @if($item->estaactivo == 'Activo')
                <form action="{{ url('/carrera/disable/'.$item->id) }}" style="display:inline" method="post">
                     {{ csrf_field() }}   
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Se archivara el registro.');" >Archivar</button>
                </form>
                @endif

                @if($item->estaactivo == 'Archivado')
                <form action="{{ url('/carrera/enable/'.$item->id) }}" style="display:inline" method="post">
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

