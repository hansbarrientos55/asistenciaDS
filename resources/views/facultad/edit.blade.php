Editar facultad
<title>Editar facultad</title>
<form action="{{url('/facultad/'.$facu->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombrefacu">{{ 'Nombre' }}</label>
<input type="text" name="nombrefacu" id="nombrefacu" value="{{$facu->nombrefacu}}" required>
    <br/>
    <label for="descripcionfacu">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcionfacu" id="descripcionfacu" value="{{$facu->descripcionfacu}}" required>
    <br/>
    <label for="estaactivo">{{ 'Activo' }}</label>
    <input type="text" name="estaactivo" id="estaactivo" value="{{$facu->estaactivo}}" required>
    <br/>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('facultad')}}">Cancelar</a>


</form>