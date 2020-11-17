@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Permisos</h1>

    @can('editar-ausencia-control')
    <a href="{{url('reposicionlista')}}" class="btn btn-success">Ver reposiciones</a>
    @endcan


    <table class="table table-light table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Motivo</th>
            <th scope="col">Fecha de ausencia</th>
            <th scope="col">Hora de ausencia</th>
            <th scope="col">Estado del permiso</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody style="background-color: #adafb1;">
            @foreach ($ausencias as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->fecha}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->motivo}}</td>
                <td>{{$item->fechaausencia}}</td>
                <td>{{$item->horaausencia}}</td>
                <td>{{$item->estaaceptada}}</td>
                <td>
                    @can('editar-ausencia-control')
                    <a class="btn btn-warning" href="{{ url('/ausencialista/'.$item->id.'/edit') }}">Editar</a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection
