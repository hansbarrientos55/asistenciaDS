Crear grupo

<form action="{{ url('/grupo') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="numerogrupo">{{ 'Numero' }}</label>
    <input type="text" name="numerogrupo" id="numerogrupo" value="" required>
    <br/>

    



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('grupo')}}">Cancelar</a>


</form>