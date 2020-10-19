Editar grupo
<title>Editar grupo</title>
<form action="{{url('/grupo/update/'.$gru->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <label for="numerogrupo">{{ 'Numero' }}</label>
    <input type="text" name="numerogrupo" id="numerogrupo" value="{{$gru->numerogrupo}}" required>
    <br/>


    <input type="submit" value="Guardar cambios">
    <a href="{{url('materia')}}">Cancelar</a>


</form>