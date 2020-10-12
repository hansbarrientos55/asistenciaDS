Editar Departamento

<form action="{{url('/departamento/'.$depa->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombredepa">{{ 'Nombre' }}</label>
<input type="text" name="nombredepa" id="nombredepa" value="{{$depa->nombredepa}}">
    <br/>
    <label for="descripciondepa">{{ 'Descripcion' }}</label>
    <input type="text" name="descripciondepa" id="descripciondepa" value="{{$depa->descripciondepa}}">
    <br/>
    <label for="estaactivo">{{ 'Activo' }}</label>
    <input type="text" name="estaactivo" id="estaactivo" value="{{$depa->estaactivo}}">
    <br/>

    <input type="submit" value="Guardar cambios">
    <a href="{{url('departamento')}}">Cancelar</a>


</form>