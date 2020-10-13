Crear usuario

<form action="{{ url('/usuario') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombres">{{ 'Nombres' }}</label>
    <input type="text" name="nombres" id="nombres" value="">
    <br/>
    <label for="apellidos">{{ 'Apellidos' }}</label>
    <input type="text" name="apellidos" id="apellidos" value="">
    <br/>
    <label for="cedula">{{ 'Cedula de identidad' }}</label>
    <input type="text" name="cedula" id="cedula" value="">
    <br/>
    <label for="fechanacimiento">{{ 'Fecha de nacimiento' }}</label>
    <input type="text" name="fechanacimiento" id="fechanacimiento" value="">
    <br/>
    <label for="direccion">{{ 'Direccion' }}</label>
    <input type="text" name="direccion" id="direccion" value="">
    <br/>
    <label for="profesion">{{ 'Profesion' }}</label>
    <input type="text" name="profesion" id="profesion" value="">
    <br/>
    <label for="codigosis">{{ 'Codigo SIS' }}</label>
    <input type="text" name="codigosis" id="codigosis" value="">
    <br/>
    <label for="contraseña">{{ 'Contraseña' }}</label>
    <input type="text" name="contraseña" id="contraseña" value="">
    <br/>



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('usuario')}}">Cancelar</a>


</form>