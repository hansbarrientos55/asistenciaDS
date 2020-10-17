Editar grupo

<form action="{{url('/grupo/'.$gru->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="numerogrupo">{{ 'Numero' }}</label>
    <input type="text" name="numerogrupo" id="numerogrupo" value="{{$gru->numerogrupo}}" required>
    <br/>


    <input type="submit" value="Guardar cambios">
    <a href="{{url('grupo')}}">Cancelar</a>


</form>