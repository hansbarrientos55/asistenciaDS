Editar materia

<form action="{{url('/materia/'.$mate->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombremate">{{ 'Nombre' }}</label>
    <input type="text" name="nombremate" id="nombremate" value="{{$mate->nombremate}}" required>
    <br/>
    <label for="codigomate">{{ 'Codigo' }}</label>
    <input type="text" name="codigomate" id="codigomate" value="{{$mate->codigomate}}" required>
    <br/>
    <label for="descripcionmate">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcionmate" id="descripcionmate" value="{{$mate->descripcionmate}}" required>
    <br/>
    <label for="nivelmate">{{ 'Nivel' }}</label>
    <input type="text" name="nivelmate" id="nivelmate" value="{{$mate->nivelmate}}" required>
    <br/>
    <label for="estaactivo">{{ 'Activo' }}</label>
    <input type="text" name="estaactivo" id="estaactivo" value="{{$mate->estaactivo}}" required>
    <br/>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('materia')}}">Cancelar</a>


</form>