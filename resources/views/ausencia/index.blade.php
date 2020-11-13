@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Permisos - Reposicion de Clases</h1>

    @can('crear-ausencia-reposicion')
    <a href="{{url('ausencia/create')}}" class="btn btn-success">Nuevo permiso</a>
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
                    @can('editar-ausencia-reposicion')
                    <a class="btn btn-warning" href="{{ url('/ausencia/'.$item->id.'/edit') }}">Editar</a>
                    @endcan

                @can('eliminar-ausencia-reposicion')
                <form action="{{ url('/ausencia/'.$item->id) }}" style="display:inline" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>
                @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
