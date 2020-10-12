Crear departamento

<form action="{{ url('/departamento') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombredepa">{{ 'Nombre' }}</label>
    <input type="text" name="nombredepa" id="nombredepa" value="">
    <br/>
    <label for="descripciondepa">{{ 'Descripcion' }}</label>
    <input type="text" name="descripciondepa" id="descripciondepa" value="">
    <br/>
    



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('departamento')}}">Cancelar</a>


</form>