Crear grupo
<title>Crear grupo</title>
<form action="{{ url('/grupo/store/'.$id) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="numerogrupo">{{ 'Numero' }}</label>
    <input type="text" name="numerogrupo" id="numerogrupo" value="" required>
    <br/>  



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('materia')}}">Cancelar</a>


</form>