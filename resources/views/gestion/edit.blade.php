@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar gestion</h1>

<form action="{{url('/gestion/'.$ges->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}

    @if($errors->first('gestion'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
               <li>{{ $errors->first('gestion')}} </li>
      </ul>
    </div>
    @endif

    <label for="periodogestion">{{ 'Periodo' }}</label>
    <input class="form-control" type="text" name="periodogestion" id="periodogestion" value="{{$ges->periodogestion}}" required>
    <br/>
    <label for="añogestion">{{ 'Año' }}</label>
    <input class="form-control" type="text" name="añogestion" id="añogestion" value="{{$ges->añogestion}}" required>
    <input class="form-control" type="text" name="gestion" id="gestion" value="" hidden>
    <br/>

    <div class="form-group">
        <label for="estaactivo" class="control-label">Estado</label>
        <input class="form-control" type="text" name="estaactivo" id="estaactivo" value="{{$ges->estaactivo}}" required readonly>
    </div>
    

    <input class="btn btn-success" type="submit" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('gestion')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection