@extends('layouts.app')

@section('content')

<div class="container">

    <title>Crear usuario</title>
<form action="{{ url('/user') }}" class= "form-horizontal" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <label for="nombres" class="control-label">{{ 'Nombres' }}</label>
        <input class="form-control" type="text" name="nombres" id="nombres" value="" required>
        
    </div>

    <div class="form-group">
    <label for="apellidos" class="control-label">{{ 'Apellidos' }}</label>
    <input class="form-control" type="text" name="apellidos" id="apellidos" value="" required>
    </div>

    <div class="form-group">
    <label for="cedula" class="control-label">{{ 'Cedula de identidad' }}</label>
    <input class="form-control" type="text" name="cedula" id="cedula" value="" required>
    </div>

    <div class="form-group">
    <label for="fechanacimiento" class="control-label">{{ 'Fecha de nacimiento (Mes - Dia - Año)' }}</label>
    <input class="form-control" type="date" name="fechanacimiento" id="fechanacimiento" value="" required>
    </div>

    <div class="form-group">
    <label for="direccion" class="control-label">{{ 'Direccion' }}</label>
    <input class="form-control" type="text" name="direccion" id="direccion" value="" required>
    </div>

    <div class="form-group">
    <label for="profesion" class="control-label">{{ 'Profesion' }}</label>
    <input class="form-control" type="text" name="profesion" id="profesion" value="" required>
    </div>

    <div class="form-group">
    <label for="username" class="control-label">{{ 'Codigo SIS' }}</label>
    <input class="form-control" type="string" name="username" id="username" value="" min="200000000" min="2000000000" required>
    </div>
    
    <div class="form-group">
    <label for="contraseña" class="control-label">{{ 'Contraseña' }}</label>
    <input class="form-control" type="password" name="contraseña" id="contraseña" value="" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Rol primario</label>
        <select name="rolprimario"  value="" class="form-control" id="rolprimario">
        @foreach ($roles as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->titulo}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Rol secundario</label>
        <select name="rolsecundario"  value="" class="form-control" id="rolsecundario">
        @foreach ($roles as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->titulo}}</option>
        @endforeach
    </select>
    </div>



  
    <input type="submit" class="btn btn-success" value="Guardar">
    <input type="reset" class="btn btn-primary" value="Limpiar campos">
    <a class="btn btn-danger" href="{{url('user')}}">Cancelar</a>


</form>

</div>
@endsection