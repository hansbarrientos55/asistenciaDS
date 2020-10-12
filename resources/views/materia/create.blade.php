Crear materia

<form action="{{ url('/materia') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombremate">{{ 'Nombre' }}</label>
    <input type="text" name="nombremate" id="nombremate" value="">
    <br/>
    <label for="codigomate">{{ 'Codigo' }}</label>
    <input type="text" name="codigomate" id="codigomate" value="">
    <br/>
    <label for="descripcionmate">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcionmate" id="descripcionmate" value="">
    <br/>
    <label for="nivelmate">{{ 'Nivel' }}</label>
    <input type="text" name="nivelmate" id="nivelmate" value="">
    <br/>



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('materia')}}">Cancelar</a>


</form>