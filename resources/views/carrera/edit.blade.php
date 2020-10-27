@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #006699;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Editar carrera</h1>

<form action="{{url('/carrera/'.$carre->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(233,237,241);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombrecarrera" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" type="text" name="nombrecarrera" id="nombrecarrera" value="{{$carre->nombrecarrera}}" required>
    <br/>
    <label for="codigocarrera" class="control-label">{{ 'Codigo' }}</label>
    <input class="form-control" type="text" name="codigocarrera" id="codigocarrera" value="{{$carre->codigocarrera}}" required>
    <br/>
    <label for="descripcioncarrera" class="control-label">{{ 'Descripcion' }}</label>
    <input class="form-control" type="text" name="descripcioncarrera" id="descripcioncarrera" value="{{$carre->descripcioncarrera}}" required>
    <br/>
    <label for="estaactivo" class="control-label">{{ 'Activo' }}</label>
    <input class="form-control" type="text" name="estaactivo" id="estaactivo" value="{{$carre->estaactivo}}" required>
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Facultad</label>
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
    <a class="btn btn-danger" href="{{url('carrera')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection