Crear carrera
<title>Crear carrera</title>
<form action="{{ url('/carrera') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombrecarrera">{{ 'Nombre' }}</label>
    <input type="text" name="nombrecarrera" id="nombrecarrera" value="" required>
    <br/>
    <label for="codigocarrera">{{ 'Codigo' }}</label>
    <input type="text" name="codigocarrera" id="codigocarrera" value="" required>
    <br/>
    <label for="descripcioncarrera">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcioncarrera" id="descripcioncarrera" value="" required>
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
    <input type="submit" value="Guardar">
    <input type="reset" value="Borrar">
    <a href="{{url('carrera')}}">Cancelar</a>


</form>