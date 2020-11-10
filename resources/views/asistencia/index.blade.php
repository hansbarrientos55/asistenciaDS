@extends('layouts.principal')

@section('content')
    

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Registro de asistencia y avance</h1>

    <a href="{{url('asistencia/create')}}" class="btn btn-success">Agregar asistencia</a>

    <table class="table table-light table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Grupo</th>
            <th scope="col">Materia</th>
            <th scope="col">Contenido de clase</th>
            <th scope="col">Plataforma</th>
            <th scope="col">Observaciones</th>
            <th scope="col">Firma</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody style="background-color: #adafb1;">
            @foreach ($asistencias as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->fecha}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->grupo}}</td>
                <td>{{$item->materia}}</td>
                <td>{{$item->contenido}}</td>
                <td>{{$item->plataforma}}</td>
                <td>{{$item->observaciones}}</td>
                <td>{{$item->firma}}</td>
                <td>
                    <a class="btn btn-warning" href="{{ url('/asistencia/'.$item->id.'/edit') }}">Editar</a>
                    <form action="{{ url('/asistencia/'.$item->id) }}" style="display:inline" method="post">
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
