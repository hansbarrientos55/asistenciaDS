@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nueva materia</h2>

<form action="{{ url('/materia') }}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombremate" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" type="text" name="nombremate" id="nombremate" value="" required>
    <br/>
    <label for="codigomate" class="control-label">{{ 'Codigo' }}</label>
    <input class="form-control" type="text" name="codigomate" id="codigomate" value="" required>
    <br/>
    <label for="descripcionmate" class="control-label">{{ 'Descripcion' }}</label>
    <input class="form-control" type="text" name="descripcionmate" id="descripcionmate" value="" required>
    <br/>
    <label for="nivelmate" class="control-label">{{ 'Nivel' }}</label>
    <input class="form-control" type="text" name="nivelmate" id="nivelmate" value="" required>
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Departamento</label>
        <select name="departamento_id"  value="" class="form-control" id="departamento_id">
        @foreach ($departamentos as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->nombredepa}}</option>
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



    <br/>
    <input class="btn btn-success" type="submit" value="Guardar">
    <input class="btn btn-primary" type="reset" value="Limpiar campos">
    <a class="btn btn-danger" href="{{url('materia')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection