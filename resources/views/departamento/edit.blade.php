@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #006699;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Editar departamento</h1>

<form action="{{url('/departamento/'.$depa->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(233,237,241);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombredepa">{{ 'Nombre' }}</label>
    <input class="form-control" type="text" name="nombredepa" id="nombredepa" value="{{$depa->nombredepa}}" required>
    <br/>
    <label for="descripciondepa">{{ 'Descripcion' }}</label>
    <input class="form-control" type="text" name="descripciondepa" id="descripciondepa" value="{{$depa->descripciondepa}}" required>
    <br/>
    <label for="estaactivo">{{ 'Activo' }}</label>
    <input class="form-control" type="text" name="estaactivo" id="estaactivo" value="{{$depa->estaactivo}}" required>
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Facultad</label>
        <select name="facultad_id"  value="" class="form-control" id="facultad_id">
        @foreach ($facultades as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->nombrefacu}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Estado</label>
        <select name="estaactivo"  value="" class="form-control" id="estaactivo">
            <option value="1">Activo</option>
            <option value="0">Archivado</option>

    </select>
    </div>

    <input class="btn btn-success" type="submit" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('departamento')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection