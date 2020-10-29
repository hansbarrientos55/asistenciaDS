@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar grupo</h1>

<form action="{{url('/grupo/update/'.$gru->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <label for="numerogrupo" class="control-label">{{ 'Numero' }}</label>
    <input class="form-control" type="text" name="numerogrupo" id="numerogrupo" value="{{$gru->numerogrupo}}" required>
    <br/>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Estado</label>
        <select name="estaactivo"  value="" class="form-control" id="estaactivo">
            <option value="1">Activo</option>
            <option value="0">Archivado</option>

    </select>
    </div>


    <input class="btn btn-success" type="submit" value="Guardar cambios">
    <a class="btn btn-danger" href="{{ url()->previous() }}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>


</div>
@endsection