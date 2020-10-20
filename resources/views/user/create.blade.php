Crear usuario
<title>Crear usuario</title>
<form action="{{ url('/user') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombres">{{ 'Nombres' }}</label>
    <input type="text" name="nombres" id="nombres" value="" required>
    <br/>
    <label for="apellidos">{{ 'Apellidos' }}</label>
    <input type="text" name="apellidos" id="apellidos" value="" required>
    <br/>
    <label for="cedula">{{ 'Cedula de identidad' }}</label>
    <input type="text" name="cedula" id="cedula" value="" required>
    <br/>
    <label for="fechanacimiento">{{ 'Fecha de nacimiento (Mes - Dia - Año)' }}</label>
    <input type="date" name="fechanacimiento" id="fechanacimiento" value="" required>
    <br/>
    <label for="direccion">{{ 'Direccion' }}</label>
    <input type="text" name="direccion" id="direccion" value="" required>
    <br/>
    <label for="profesion">{{ 'Profesion' }}</label>
    <input type="text" name="profesion" id="profesion" value="" required>
    <br/>
    <label for="codigosis">{{ 'Codigo SIS' }}</label>
    <input type="number" name="codigosis" id="codigosis" value="" min="200000000" min="2000000000" required>
    <br/>
    <label for="contraseña">{{ 'Contraseña' }}</label>
    <input type="password" name="contraseña" id="contraseña" value="" required>
    <br/>



    <br/>
    <input type="submit" value="Guardar">
    <input type="reset" value="Borrar">
    <a href="{{url('user')}}">Cancelar</a>


</form>