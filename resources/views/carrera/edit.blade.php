Editar carrera

<form action="{{url('/carrera/'.$carre->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombrecarrera">{{ 'Nombre' }}</label>
    <input type="text" name="nombrecarrera" id="nombrecarrera" value="{{$carre->nombrecarrera}}" required>
    <br/>
    <label for="codigocarrera">{{ 'Codigo' }}</label>
    <input type="text" name="codigocarrera" id="codigocarrera" value="{{$carre->codigocarrera}}" required>
    <br/>
    <label for="descripcioncarrera">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcioncarrera" id="descripcioncarrera" value="{{$carre->descripcioncarrera}}" required>
    <br/>
    <label for="estaactivo">{{ 'Activo' }}</label>
    <input type="text" name="estaactivo" id="estaactivo" value="{{$carre->estaactivo}}" required>
    <br/>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('carrera')}}">Cancelar</a>


</form>