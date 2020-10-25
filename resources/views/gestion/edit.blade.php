@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #006699;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Editar departamento</h1>

<form action="{{url('/gestion/'.$ges->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(233,237,241);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="periodogestion">{{ 'Periodo' }}</label>
    <input class="form-control" type="text" name="periodogestion" id="periodogestion" value="{{$ges->periodogestion}}" required>
    <br/>
    <label for="añogestion">{{ 'Año' }}</label>
    <input class="form-control" type="text" name="añogestion" id="añogestion" value="{{$ges->añogestion}}" required>
    <br/>
    

    <input class="btn btn-success" type="submit" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('gestion')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection