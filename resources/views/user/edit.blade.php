@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">
                    
    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar usuario</h1>

    

    <form action="{{url('/user/'.$usu->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <div class="form-group">
    <label for="nombres" class="control-label">{{ 'Nombres' }}</label>
    <input class="form-control" type="text" name="nombres" id="nombres" value="{{$usu->nombres}}" required>
    </div>

    <div class="form-group">
    <label for="apellidos" class="control-label">{{ 'Apellidos' }}</label>
    <input class="form-control" type="text" name="apellidos" id="apellidos" value="{{$usu->apellidos}}" required>
    </div>

    <div class="form-group">
    <label for="cedula" class="control-label">{{ 'Cedula de identidad' }}</label>
    <input class="form-control" type="text" name="cedula" id="cedula" value="{{$usu->cedula}}" required>
    @if($errors->first('cedula'))
     <div class="alert alert-danger" role ="alert" >
       <ul>
                <li>{{ $errors->first('cedula')}} </li>
       </ul>
     </div>
     @endif
    </div>

    <div class="form-group">
    <label for="fechanacimiento" class="control-label">{{ 'Fecha de nacimiento  (Mes - Dia - Año)' }}</label>
    <input class="form-control" type="date" name="fechanacimiento" id="fechanacimiento" value="{{$usu->fechanacimiento}}" required>
    </div>

    <div class="form-group">
    <label for="direccion" class="control-label">{{ 'Direccion' }}</label>
    <input class="form-control" type="text" name="direccion" id="direccion" value="{{$usu->direccion}}" required>
    </div>

    <div class="form-group">
    <label for="profesion" class="control-label">{{ 'Profesion' }}</label>
    <input class="form-control" type="text" name="profesion" id="profesion" value="{{$usu->profesion}}" required>
    </div>

    <div class="form-group">
    <label for="username" class="control-label">{{ 'Codigo SIS' }}</label>
    <input class="form-control" type="string" name="username" id="username" value="{{$usu->username}}" required>
    @if($errors->first('username'))
     <div class="alert alert-danger" role ="alert" >
       <ul>
                <li>{{ $errors->first('username')}} </li>
       </ul>
     </div>
     @endif
    </div>

    <div class="form-group">
    <label for="contrasenia" class="control-label">{{ 'Contraseña' }}</label>
    <input class="form-control" type="password" name="contrasenia" id="contrasenia" value="{{$usu->contrasenia}}" required>
    </div>

    <div class="form-group">
        <label for="emailprincipal" class="control-label">{{ 'Email principal' }}</label>
        <input class="form-control" type="email" name="emailprincipal" id="emailprincipal" value="{{$usu->emailprincipal}}" required>
        @if($errors->first('emailprincipal'))
     <div class="alert alert-danger" role ="alert" >
       <ul>
                <li>{{ $errors->first('emailprincipal')}} </li>
       </ul>
     </div>
     @endif
    </div>

    <div class="form-group">
        <label for="emailsecundario" class="control-label">{{ 'Email secundario' }}</label>
        <input class="form-control" type="email" name="emailsecundario" id="emailsecundario" value="{{$usu->emailsecundario}}" required>
    </div>

    <div class="form-group">
        <label for="telefonoprincipal" class="control-label">{{ 'Telefono principal' }}</label>
        <input class="form-control" type="number" name="telefonoprincipal" id="telefonoprincipal" value="{{$usu->telefonoprincipal}}" required>
        @if($errors->first('telefonoprincipal'))
     <div class="alert alert-danger" role ="alert" >
       <ul>
                <li>{{ $errors->first('telefonoprincipal')}} </li>
       </ul>
     </div>
     @endif
    </div>

    <div class="form-group">
        <label for="telefonosecundario" class="control-label">{{ 'Telefono secundario' }}</label>
        <input class="form-control" type="number" name="telefonosecundario" id="telefonosecundario" value="{{$usu->telefonosecundario}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Rol primario</label>
        <select name="rolprimario"  value="" class="form-control" id="rolprimario">
        @foreach ($roles as $key=>$value)
                <option value="{{$value}}" >{{$value}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Rol secundario</label>
        <select name="rolsecundario"  value="" class="form-control" id="rolsecundario">
        @foreach ($roles as $key=>$value)
                <option value="{{$value}}" >{{$value}}</option>
        @endforeach
    </select>
    </div>


    <div class="form-group">
        <label for="estaactivo" class="control-label">Estado</label>
        <input class="form-control" type="text" name="estaactivo" id="estaactivo" value="{{$usu->estaactivo}}" required readonly>
    </div>

    <input type="submit" class="btn btn-success" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('user')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection