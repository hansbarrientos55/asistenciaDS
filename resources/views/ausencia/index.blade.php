@extends('layouts.principal')

@section('content')

<div class="container">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Permisos y Reposiciones de Clases</h1>

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
            <th scope="col">Archivo</th>
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
                    @can('editar-ausencia-reposicion')
                    <a class="btn btn-primary" href="{{ url('/reposicion/'.$item->id.'/index') }}">Ver reposicion</a> 
                    @endcan

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
