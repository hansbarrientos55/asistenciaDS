Crear departamento
<title>Crear departamento</title>
<form action="{{ url('/departamento') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombredepa">{{ 'Nombre' }}</label>
    <input type="text" name="nombredepa" id="nombredepa" value="" required>
    <br/>
    <label for="descripciondepa">{{ 'Descripcion' }}</label>
    <input type="text" name="descripciondepa" id="descripciondepa" value="" required>
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Facultad</label>
        <select name="facultad_id"  value="" class="form-control" id="facultad_id">
        @foreach ($facultades as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->nombrefacu}}</option>
        @endforeach
    </select>
    </div>



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('departamento')}}">Cancelar</a>


</form>