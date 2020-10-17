Crear carrera

<form action="{{ url('/carrera') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombrecarrera">{{ 'Nombre' }}</label>
    <input type="text" name="nombrecarrera" id="nombrecarrera" value="" required>
    <br/>
    <label for="codigocarrera">{{ 'Codigo' }}</label>
    <input type="text" name="codigocarrera" id="codigocarrera" value="" required>
    <br/>
    <label for="descripcioncarrera">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcioncarrera" id="descripcioncarrera" value="" required>
    <br/>



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('carrera')}}">Cancelar</a>


</form>