@extends('layouts.app')

@section('content')

<div class="container">

<title>Editar rol</title>
<form action="{{url('/role/'.$ro->id)}}" class= "form-horizontal" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <div class="form-group">
    <label for="titulo" class="control-label">{{ 'Titulo' }}</label>
    <input class="form-control" type="text" name="titulo" id="titulo" value="{{$ro->titulo}}" required>
    </div>


    <input type="submit" class="btn btn-success" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('role')}}">Cancelar</a>


</form>

</div>
@endsection