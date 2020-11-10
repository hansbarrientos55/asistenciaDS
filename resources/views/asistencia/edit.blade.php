@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar asistencia y avance</h1>

<form action="{{url('/asistencia/'.$asi->id)}}"  class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="">Modificar datos</label>
    <div class="form-group">
        <label for="fecha" class="control-label">{{ 'Fecha' }}</label>
        <input class="form-control" type="text" name="fecha" id="fecha" value="{{$asi->fecha}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="hora" class="control-label">{{ 'Hora' }}</label>
        <input class="form-control" type="text" name="hora" id="hora" value="{{$asi->hora}}" required readonly>
    </div>  
    <div class="form-group">
        <label for="exampleFormControlSelect1">Grupo</label>
        <select name="grupo" class="form-control" id="grupo">
            @foreach ($grupos as $item)
                <option value="{{$item->numerogrupo}}">{{$item->numerogrupo}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Materia</label>
        <select name="materia" class="form-control" id="materia">
            @foreach ($materias as $item)
                <option value="{{$item->nombremate}}">{{$item->nombremate}}</option>
            @endforeach
        </select>
    </div>
      
    <div class="form-group">
        <label for="contenido" class="control-label">{{ 'Contenido' }}</label>
        <input class="form-control" type="text" name="contenido" id="contenido" value="{{$asi->contenido}}" required>
    </div>  

    <div class="form-group">
        <label for="plataforma" class="control-label">{{ 'Plataforma' }}</label>
        <input class="form-control" type="text" name="plataforma" id="plataforma" value="{{$asi->plataforma}}" required>
    </div>  
    <div class="form-group">
        <label for="obervaciones" class="control-label">{{ 'Observaciones' }}</label>
        <input class="form-control" type="text" name="observaciones" id="observaciones" value="{{$asi->observaciones}}" required>
    </div>  

    <div class="form-group">
        <label for="firma" class="control-label">{{ 'Firma' }}</label>
        <input class="form-control" type="text" name="firma" id="firma" value="{{$asi->firma}}" required>
    </div>  
    <input type="submit" class="btn btn-success" value="Guardar">
    <a class="btn btn-danger" href="{{url('asistencia')}}">Cancelar</a>

</form>

</div>
</div>
</div>
</div>

</div>
@endsection