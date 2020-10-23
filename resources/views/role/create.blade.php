@extends('layouts.app')

@section('content')

<div class="container">

    <title>Crear rol</title>
<form action="{{ url('/role') }}" class= "form-horizontal" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <label for="titulo" class="control-label">{{ 'Titulo' }}</label>
        <input class="form-control" type="text" name="titulo" id="titulo" value="" required>
        
    </div>

  
    <input type="submit" class="btn btn-success" value="Guardar">
    <input type="reset" class="btn btn-primary" value="Limpiar campos">
    <a class="btn btn-danger" href="{{url('role')}}">Cancelar</a>


</form>

</div>
@endsection