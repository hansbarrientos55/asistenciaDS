@extends('layouts.principal')

@section('content')

<div class="container">
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #006699;">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Editar rol</h1>

<form action="{{url('/role/'.$ro->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(233,237,241);" style="font-family: Arial;color: rgb(233,237,241);"  method="post" enctype="multipart/form-data">
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
</div>
</div>
</div>


</div>
@endsection