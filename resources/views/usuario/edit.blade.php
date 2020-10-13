Editar usuario

<form action="{{url('/usuario/'.$usu->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombres">{{ 'Nombres' }}</label>
    <input type="text" name="nombres" id="nombres" value="{{$usu->nombres}}">
    <br/>
    <label for="apellidos">{{ 'Apellidos' }}</label>
    <input type="text" name="apellidos" id="codigomate" value="{{$usu->apellidos}}">
    <br/>
    <label for="cedula">{{ 'Cedula de identidad' }}</label>
    <input type="text" name="cedula" id="cedula" value="{{$usu->cedula}}">
    <br/>
    <label for="fechanacimiento">{{ 'Fecha de nacimiento' }}</label>
    <input type="text" name="fechanacimiento" id="fechanacimiento" value="{{$usu->fechanacimiento}}">
    <br/>
    <label for="direccion">{{ 'Direccion' }}</label>
    <input type="text" name="direccion" id="direccion" value="{{$usu->direccion}}">
    <br/>
    <label for="profesion">{{ 'Profesion' }}</label>
    <input type="text" name="profesion" id="profesion" value="{{$usu->profesion}}">
    <br/>
    <label for="codigosis">{{ 'Codigo SIS' }}</label>
    <input type="text" name="codigosis" id="codigosis" value="{{$usu->codigosis}}">
    <br/>
    <label for="contraseña">{{ 'Contraseña' }}</label>
    <input type="text" name="contraseña" id="contraseña" value="{{$usu->contraseña}}">
    <br/>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('usuario')}}">Cancelar</a>


</form>