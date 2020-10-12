Editar facultad

<form action="{{url('/facultad/'.$facu->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombrefacu">{{ 'Nombre' }}</label>
<input type="text" name="nombrefacu" id="nombrefacu" value="{{$facu->nombrefacu}}">
    <br/>
    <label for="descripcionfacu">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcionfacu" id="descripcionfacu" value="{{$facu->descripcionfacu}}">
    <br/>
    <label for="estaactivo">{{ 'Activo' }}</label>
    <input type="text" name="estaactivo" id="estaactivo" value="{{$facu->estaactivo}}">
    <br/>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('facultad')}}">Cancelar</a>


</form>