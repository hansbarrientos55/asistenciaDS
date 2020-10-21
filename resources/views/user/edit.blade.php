Editar usuario
<title>Editar usuario</title>
<form action="{{url('/user/'.$usu->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombres">{{ 'Nombres' }}</label>
    <input type="text" name="nombres" id="nombres" value="{{$usu->nombres}}" required>
    <br/>
    <label for="apellidos">{{ 'Apellidos' }}</label>
    <input type="text" name="apellidos" id="codigomate" value="{{$usu->apellidos}}" required>
    <br/>
    <label for="cedula">{{ 'Cedula de identidad' }}</label>
    <input type="text" name="cedula" id="cedula" value="{{$usu->cedula}}" required>
    <br/>
    <label for="fechanacimiento">{{ 'Fecha de nacimiento' }}</label>
    <input type="date" name="fechanacimiento" id="fechanacimiento" value="{{$usu->fechanacimiento}}" required>
    <br/>
    <label for="direccion">{{ 'Direccion' }}</label>
    <input type="text" name="direccion" id="direccion" value="{{$usu->direccion}}" required>
    <br/>
    <label for="profesion">{{ 'Profesion' }}</label>
    <input type="text" name="profesion" id="profesion" value="{{$usu->profesion}}" required>
    <br/>
    <label for="username">{{ 'Codigo SIS' }}</label>
    <input type="string" name="username" id="username" value="{{$usu->username}}" required>
    <br/>
    <label for="contraseña">{{ 'Contraseña' }}</label>
    <input type="password" name="contraseña" id="contraseña" value="{{$usu->contraseña}}" required>
    <br/>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('user')}}">Cancelar</a>


</form>