Crear materia
<title>Crear materia</title>
<form action="{{ url('/materia') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombremate">{{ 'Nombre' }}</label>
    <input type="text" name="nombremate" id="nombremate" value="" required>
    <br/>
    <label for="codigomate">{{ 'Codigo' }}</label>
    <input type="text" name="codigomate" id="codigomate" value="" required>
    <br/>
    <label for="descripcionmate">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcionmate" id="descripcionmate" value="" required>
    <br/>
    <label for="nivelmate">{{ 'Nivel' }}</label>
    <input type="text" name="nivelmate" id="nivelmate" value="" required>
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Departamento</label>
        <select name="departamento_id"  value="" class="form-control" id="departamento_id">
        @foreach ($departamentos as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->nombredepa}}</option>
        @endforeach
    </select>
    </div>



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('materia')}}">Cancelar</a>


</form>