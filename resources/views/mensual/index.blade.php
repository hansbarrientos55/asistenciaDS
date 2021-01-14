@extends('layouts.principal')

@section('content')
    

<div class="container-fluid" style="width: auto">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Registro de asistencia y avance Mensual</h1>

    <div>
        @hasrole('Jefe de Departamento')
        <a href="{{url('mensual/create')}}" class="btn btn-success">Agregar registro de asistencia mensual</a>
        <a href="{{url('prepararmensual')}}" class="btn btn-info">Preparar impresion</a>
        @endrole
        <br>
        <br>
        

    </div>
    

    <table class="table table-responsive table-light table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Mes</th>
            <th scope="col">Usuario</th>
            <th scope="col">Horas asignadas</th>
            <th scope="col">Horas trabajadas</th>
            <th scope="col">Faltas (Horas)</th>
            <th scope="col">Licencias (Horas)</th>
            <th scope="col">Bajas (Horas)</th>
            <th scope="col">Comision (Horas)</th>
            <th scope="col">Total Horas Pagables</th>
            <th scope="col">Visto Bueno</th>
            <th scope="col">Firma</th>
            <th scope="col">Archivo</th>
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
                <td>{{$item->usuario}}</td>
                <td>{{$item->horas}}</td>
                <td>{{$item->asistidas}}</td>
                <td>{{$item->faltas}}</td>
                <td>{{$item->licencia}}</td>
                <td>{{$item->baja}}</td>
                <td>{{$item->comision}}</td>
                <td>{{$item->totalpagables}}</td>
                <td>{{$item->vistobueno}}</td>
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

                    @can('mensual-control')
                    <a class="btn btn-warning" href="{{ url('/mensual/'.$item->id.'/edit') }}">Editar</a>
                    @endcan

                    @can('mensual-control')
                    <form action="{{ url('/mensual/'.$item->id) }}" style="display:inline" method="post">
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
    <a class="btn btn-dark" href="{{ url('asistenciamenu') }}">Volver a administracion</a>
</div>
@endsection
