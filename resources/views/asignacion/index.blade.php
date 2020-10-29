@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Administracion de Asignaciones de Materias - Grupos - Horarios</h1>

    <a href="{{url('asignacion/create')}}" class="btn btn-success">Asignar materia a docente</a>

    <table class="table table-light table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Gestion</th>
            <th scope="col">Departamento</th>
            <th scope="col">Docente</th>
            <th scope="col">Materia</th>
            <th scope="col">Grupo</th>
            <th scope="col">Horario</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody style="background-color: #adafb1;">
            @foreach ($asignaciones as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->gestion}}</td>
                <td>{{$item->departamento}}</td>
                <td>{{$item->docente}}</td>
                <td>{{$item->materia}}</td>
                <td>{{$item->grupo}}</td>
                <td>{{$item->horario}}</td>
                <td>
                    <a class="btn btn-warning" href="{{ url('/asignacion/'.$item->id.'/edit') }}">Editar</a>
                    

                <form action="{{ url('/asignacion/'.$item->id) }}" style="display:inline" method="post">
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
