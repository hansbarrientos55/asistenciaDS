@extends('layouts.principal')

@section('content')
    

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Reposicion de clase</h1>

    @can('crear-asistencia-avance')
    <a href="{{url('reposicion/create/'.$id)}}" class="btn btn-success">Agregar reposicion</a>
    @endcan

    <table class="table table-light table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Horario</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody style="background-color: #adafb1;">
            @foreach ($reposicion as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->fecha}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->horario}}</td>
                <td>{{$item->estado}}</td>
                <td>

                    @can('editar-asistencia-avance')
                    <a class="btn btn-warning" href="{{ url('/reposicion/edit/'.$item->id) }}">Editar</a>
                    @endcan

                    @can('eliminar-asistencia-avance')
                    <form action="{{ url('/reposicion/delete/'.$item->id) }}" style="display:inline" method="post">
                        {{ csrf_field() }}   
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                    </form>
                    @endcan

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a class="btn btn-dark" href="{{ url('ausencia') }}">Volver a permisos</a>

</div>
@endsection
