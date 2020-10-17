Editar usuario

<form action="{{url('/usuario/'.$usu->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombres">{{ 'Nombres' }}</label>
    <input type="text" name="nombres" id="nombres" value="{{$usu->nombres}}" required>
    <br/>
    <label for="apellidos">{{ 'Apellidos' }}</label>
    <input type="text" name="apellidos" id="codigomate" value="{{$usu->apellidos}}" required>
    <br/>
    <label for="cedula">{{ 'Cedula de identidad' }}</label>
    <input type="text" name="cedula" id="cedula" value="{{$usu->cedula}}" required
    <br/>
    <label for="fechanacimiento">{{ 'Fecha de nacimiento' }}</label>
    <input type="text" name="fechanacimiento" id="fechanacimiento" value="{{$usu->fechanacimiento}}" required>
    <br/>
    <label for="direccion">{{ 'Direccion' }}</label>
    <input type="text" name="direccion" id="direccion" value="{{$usu->direccion}}" required>
    <br/>
    <label for="profesion">{{ 'Profesion' }}</label>
    <input type="text" name="profesion" id="profesion" value="{{$usu->profesion}}" required>
    <br/>
    <label for="codigosis">{{ 'Codigo SIS' }}</label>
    <input type="text" name="codigosis" id="codigosis" value="{{$usu->codigosis}}" required>
    <br/>
    <label for="contraseña">{{ 'Contraseña' }}</label>
    <input type="text" name="contraseña" id="contraseña" value="{{$usu->contraseña}}" required>
    <br/>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('usuario')}}">Cancelar</a>


</form>