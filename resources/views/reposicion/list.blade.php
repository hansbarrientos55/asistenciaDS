@extends('layouts.principal')

@section('content')
    

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Reposiciones</h1>

    <table class="table table-light table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Nueva fecha</th>
            <th scope="col">Nueva hora</th>
            <th scope="col">Grupo</th>
            <th scope="col">Materia</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody style="background-color: #adafb1;">
            @foreach ($reposiciones as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->fecha}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->nuevafecha}}</td>
                <td>{{$item->horario}}</td>
                <td>{{$item->grupo}}</td>
                <td>{{$item->materia}}</td>
                <td>{{$item->estado}}</td>
                <td>
                    @can('editar-ausencia-control')
                    <a class="btn btn-warning" href="{{ url('/reposicionlista/'.$item->id.'/edit') }}">Editar</a>
                    @endcan
                   

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-dark" href="{{ url('ausencialista') }}">Volver a permisos</a>
</div>
@endsection
