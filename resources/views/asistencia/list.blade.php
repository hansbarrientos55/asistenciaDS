@extends('layouts.principal')

@section('content')
    

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Asistencias y Avances semanales</h1>


    <table class="table table-light table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Mes</th>
            <th scope="col">Inicio semana</th>
            <th scope="col">Fin semana</th>
            <th scope="col">Usuario</th>
            <th scope="col">Tipo</th>
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
                <td>{{$item->mes}}</td>
                <td>{{$item->iniciosemana}}</td>
                <td>{{$item->finsemana}}</td>
                <td>{{$item->user_id}}</td>
                <td>{{$item->tipo}}</td>
                <td>{{$item->grupo}}</td>
                <td>{{$item->materia}}</td>
                <td>{{$item->contenido}}</td>
                <td>{{$item->plataforma}}</td>
                <td>{{$item->observaciones}}</td>
                <td>{{$item->firma}}</td>
                <td>

                   

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
