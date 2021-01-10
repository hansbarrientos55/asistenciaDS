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
    <div class="form-group">
        <label for="fecha" class="control-label">Fecha</label>
        <input class="form-control" type="text" name="fecha" id="fecha" value="{{$asi->fecha}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="hora" class="control-label">Hora</label>
        <input class="form-control" type="text" name="hora" id="hora" value="{{$asi->hora}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="mes" class="control-label">Mes</label>
        <input class="form-control" type="string" name="mes" id="mes" value="{{ $asi->mes }}" required readonly>
    </div> 

    <div class="form-group">
        <label for="iniciosemana" class="control-label">Inicio semana</label>
        <input class="form-control" type="string" name="iniciosemana" id="iniciosemanas" value="{{ $asi->iniciosemana }}" required readonly>
    </div> 

    <div class="form-group">
        <label for="finsemana" class="control-label">Fin semana</label>
        <input class="form-control" type="string" name="finsemana" id="finsemana" value="{{ $asi->finsemana }}" required readonly>
    </div>


    <div class="form-group">
        <label for="tipo" class="control-label">Tipo de clase</label>
        <input class="form-control" type="string" name="tipo" id="tipo" value="{{ $asi->tipo }}" required readonly>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Horario</label>
        <select name="horario" class="form-control" id="horario">
            @foreach ($horarios as $item)
                <option value="{{$item->hora}}">{{$item->hora}}</option>
            @endforeach
        </select>
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
        <label for="contenido" class="control-label">Contenido de la clase</label>
        <input class="form-control" type="text" name="contenido" id="contenido" value="{{$asi->contenido}}" required>
    </div>  

    <label for="plataforma" class="control-label">Plataforma o medio utilizado</label>

    <div class="form-group">
        <label for="repositorio" class="control-label">Repositorio</label>
        <select name="repositorio"  value="" class="form-control" id="repositorio">
            <option value="Google Drive">Google Drive</option>
        </select>
    </div>  

    <div class="form-group">
        <label for="notificacion" class="control-label">Notificacion</label>
        <select name="notificacion"  value="" class="form-control" id="notificacion">
            <option value="Gmail">Gmail</option>
            <option value="Whatsapp">Whatsapp</option>
            <option value="Telegram">Telegram</option>
        </select>
    </div> 

    <div class="form-group">
        <label for="claseonline" class="control-label">Clase online</label>
        <select name="claseonline"  value="" class="form-control" id="claseonline">
            <option value="Google Classroom">Google Classroom</option>
            <option value="Zoom">Zoom</option>
        </select>
    </div>
    

    <div class="form-group">
        <label for="obervaciones" class="control-label">Observaciones</label>
        <input class="form-control" type="text" name="observaciones" id="observaciones" value="{{$asi->observaciones}}" required>
    </div>  

    <div class="form-group">
        <label for="firma" class="control-label">Firma</label>
        <input class="form-control" type="text" name="firma" id="firma" value="{{$asi->firma}}" required>
    </div>  

    @hasrole('Auxiliar de Docencia')
    <div class="form-group">
        <label for="grabacion" class="control-label">Enlace de la grabacion</label>
        <input class="form-control" type="text" name="grabacion" id="grabacion" value="{{$asi->grabacion}}" required>
    </div> 
    @endrole

    @hasrole('Auxiliar de Laboratorio')
    <div class="form-group">
        <label for="tarea" class="control-label">Tarea</label>
        <input class="form-control" type="text" name="tarea" id="tarea" value="{{$asi->tarea}}" required>
    </div> 
    @endrole

    <input type="submit" class="btn btn-success" value="Guardar">
    <a class="btn btn-danger" href="{{url('asistencia')}}">Cancelar</a>

</form>

</div>
</div>
</div>
</div>

</div>
@endsection