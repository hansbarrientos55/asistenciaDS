@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" ></h1>

<form action="{{url('/ausencia/'.$ause->id)}}"  class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}

    <label for="">Editar permiso</label>
    <br/>
    @if($errors->first('motivo'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
                <li>{{ $errors->first('motivo')}} </li>
      </ul>
    </div>
   
    @endif 
    <input class="form-control" type="text" name="usuario" id="usuario" value="{{$ause->id}}" hidden>


    <div class="form-group">
        <label for="fecha" class="control-label">Fecha</label>
        <input class="form-control" type="text" name="fecha" id="fecha" value="{{$ause->fecha}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="hora" class="control-label">Hora</label>
        <input class="form-control" type="text" name="hora" id="hora" value="{{$ause->hora}}" required readonly>
    </div>

    @role('Docente')
    <div class="form-group">
        <label for="motivo" class="control-label">Motivo</label>
        <input class="form-control" type="text" name="motivo" id="motivo" value="{{$ause->motivo}}" required>
    </div> 
    @endrole

    @role('Jefe de Departamento')
    <div class="form-group">
        <label for="motivo" class="control-label">Motivo</label>
        <input class="form-control" type="text" name="motivo" id="motivo" value="{{$ause->motivo}}" readonly required>
    </div> 
    @endrole


    @role('Docente')
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <select name="tipo" class="form-control" id="tipo">
                <option value="Licencia">Licencia</option>
                <option value="Baja">Baja</option>
                <option value="Comision">Comision</option>
        </select>
    </div>

    @if($errors->first('fechaausencia'))
          <div class="alert alert-danger" role ="alert" >
            <ul>
                      <li>{{ $errors->first('fechaausencia')}} </li>
            </ul>
          </div>
         
          @endif 
    <div class="form-group">
        <label for="fechaausencia" class="control-label">Fecha de ausencia</label>
    <input class="form-control" type="date" name="fechaausencia" id="fechaausencia" value="{{$ause->fechaausencia}}" required>
    </div>  
    @endrole

    @role('Jefe de Departamento')
    <div class="form-group">
        <label for="tipo" class="control-label">Tipo</label>
        <input class="form-control" type="text" name="tipo" id="tipo" value="{{$ause->tipo}}" readonly required>
    </div>
    <div class="form-group">
        <label for="fechaausencia" class="control-label">Fecha de ausencia</label>
        <input class="form-control" type="date" name="fechaausencia" id="fechaausencia" value="{{$ause->fechaausencia}}" readonly required>
    </div> 
    @endrole

    @role('Docente')
    <div class="form-group">
        <label for="horaausencia">Hora de ausencia</label>
        <select name="horaausencia" class="form-control" id="horaausencia">
            @foreach ($horas as $item)
                <option value="{{$item->hora}}">{{$item->hora}}</option>
            @endforeach
        </select>
    </div>
    @endrole


    @role('Jefe de Departamento')
    <div class="form-group">
        <label for="horaausencia" class="control-label">Hora de ausencia</label>
        <input class="form-control" type="string" name="horaausencia" id="horaausencia" value="{{$ause->horaausencia}}" readonly required>
    </div>
    @endrole


    <input type="submit" class="btn btn-success" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('ausencia')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection