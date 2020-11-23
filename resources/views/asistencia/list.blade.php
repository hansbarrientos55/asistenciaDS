@extends('layouts.principal')

@section('content')
    

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Asistencias y Avances Semanales</h1>

    <div>
        <a class="btn btn-dark" href="{{ url('asistenciamenu') }}">Volver a administracion</a>
    <br>
    </div>
    
    <div>

    <br>    
    </div>

    

    <table class="table table-light table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Usuario</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Mes</th>
            <th scope="col">Inicio semana</th>
            <th scope="col">Fin semana</th>
            <th scope="col">Tipo</th>
            <th scope="col">Grupo</th>
            <th scope="col">Materia</th>
            <th scope="col">Contenido de clase</th>
            <th scope="col">Plataforma o medio utilizado</th>
            <th scope="col">Observaciones</th>
            <th scope="col">Firma</th>
            <th scope="col">Archivo</th>
        </tr>
        </thead>
        <tbody style="background-color: #adafb1;">
            @foreach ($asistencias as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->user_id}}</td>
                <td>{{$item->fecha}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->mes}}</td>
                <td>{{$item->iniciosemana}}</td>
                <td>{{$item->finsemana}}</td>
                <td>{{$item->tipo}}</td>
                <td>{{$item->grupo}}</td>
                <td>{{$item->materia}}</td>
                <td>{{$item->contenido}}</td>
                <td>{{'Repositorio : '.$item->repositorio.', Notificacion : '.$item->notificacion.', Clase online : '.$item->claseonline}}</td>
                <td>{{$item->observaciones}}</td>
                <td>{{$item->firma}}</td>
                @if($item->archivo != "")
                <div>
                    <td><a href="{{Storage::url($item->archivo)}}"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-earmark-check-fill" fill="#274453" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7.5 1.5v-2l3 3h-2a1 1 0 0 1-1-1zm1.354 4.354a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                      </svg></a></td>
                </div>
                @else
                <td>{{$item->archivo}}</td>
                @endif
                <td>

                   

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
