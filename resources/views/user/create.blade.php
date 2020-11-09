@extends('layouts.principal')

@section('content')

<div class="container">
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nuevo usuario</h2>

    

    <form action="{{ url('/user') }}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
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
    <label for="contrasenia" class="control-label">{{ 'Contraseña' }}</label>
    <input class="form-control" type="password" name="contrasenia" id="contrasenia" value="" required>
    </div>

    <div class="form-group">
        <label for="emailprincipal" class="control-label">{{ 'Email principal' }}</label>
        <input class="form-control" type="email" name="emailprincipal" id="emailprincipal" value="" required>
    </div>

    <div class="form-group">
        <label for="emailsecundario" class="control-label">{{ 'Email secundario' }}</label>
        <input class="form-control" type="email" name="emailsecundario" id="emailsecundario" value="" required>
    </div>

    <div class="form-group">
        <label for="telefonoprincipal" class="control-label">{{ 'Telefono principal' }}</label>
        <input class="form-control" type="number" name="telefonoprincipal" id="telefonoprincipal" value="" required>
    </div>

    <div class="form-group">
        <label for="telefonosecundario" class="control-label">{{ 'Telefono secundario' }}</label>
        <input class="form-control" type="number" name="telefonosecundario" id="telefonosecundario" value="" required>
    </div>
        

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Rol primario</label>
        <select name="rolprimario"  value="" class="form-control" id="rolprimario">
        @foreach ($roles as $key=>$value)
            <option value="{{$value}}">{{$value}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Rol secundario</label>
        <select name="rolsecundario"  value="" class="form-control" id="rolsecundario">
        @foreach ($roles as $key=>$value)
            <option value="{{$value}}">{{$value}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Estado</label>
        <select name="estaactivo"  value="" class="form-control" id="estaactivo">
            <option value="1">Activo</option>
            <option value="0">Archivado</option>

    </select>
    </div>

  
    <input type="submit" class="btn btn-success" value="Guardar">
    <input type="reset" class="btn btn-primary" value="Limpiar campos">
    <a class="btn btn-danger" href="{{url('user')}}">Cancelar</a>


</form>
</div>
</div>
</div>
</div>

</div>
@endsection