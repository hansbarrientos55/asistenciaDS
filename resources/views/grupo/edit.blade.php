@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #006699;">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Editar grupo</h1>

<form action="{{url('/grupo/update/'.$gru->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(233,237,241);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <label for="numerogrupo" class="control-label">{{ 'Numero' }}</label>
    <input class="form-control" type="text" name="numerogrupo" id="numerogrupo" value="{{$gru->numerogrupo}}" required>
    <br/>


    <input class="btn btn-success" type="submit" value="Guardar cambios">
    <a class="btn btn-danger" href="{{ url()->previous() }}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>


</div>
@endsection