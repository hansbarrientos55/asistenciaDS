Editar Departamento
<title>Editar departamento</title>
<form action="{{url('/departamento/'.$depa->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombredepa">{{ 'Nombre' }}</label>
<input type="text" name="nombredepa" id="nombredepa" value="{{$depa->nombredepa}}" required>
    <br/>
    <label for="descripciondepa">{{ 'Descripcion' }}</label>
    <input type="text" name="descripciondepa" id="descripciondepa" value="{{$depa->descripciondepa}}" required>
    <br/>
    <label for="estaactivo">{{ 'Activo' }}</label>
    <input type="text" name="estaactivo" id="estaactivo" value="{{$depa->estaactivo}}" required>
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Facultad</label>
        <select name="facultad_id"  value="" class="form-control" id="facultad_id">
        @foreach ($facultades as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->nombrefacu}}</option>
        @endforeach
    </select>
    </div>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('departamento')}}">Cancelar</a>


</form>