@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Lista de respaldos</h1>

    <a href="{{url('migracion')}}" class="btn btn-dark">Volver a Migraciones y Respaldos</a>

<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>

            <th>Nombre</th>
            <th>Tamaño</th>
            <th>Fecha de creacion</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody style="background-color: #adafb1;">
        @foreach ($respaldos as $item)
            
            <tr>
                <td>{{ $item['Nombre'] }}</td>
                <td>{{ $item['Tamaño'] }}</td>
                <td>{{ $item['Modificado'] }}</td>
                <td> 
                    
                <a class="btn btn-light" href="{{ url('/respaldo/descarga/'.$item['Nombre']) }}">Descargar</a>

        


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

</div>
@endsection