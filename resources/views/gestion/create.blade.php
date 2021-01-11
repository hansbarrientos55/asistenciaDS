@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nueva gestion</h2>

    @if($errors->first('gestion'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
               <li>{{ $errors->first('gestion')}} </li>
      </ul>
    </div>
    @endif


    <form action="{{ url('/gestion') }}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
    <label for="periodogestion">{{ 'Periodo' }}</label>
    <input class="form-control" type="text" name="periodogestion" id="periodogestion" value="{{ old('periodogestion') }}" required>
    </div>

    <div class="form-group">
        <input class="form-control" type="text" name="gestion" id="gestion" value="" hidden>
    </div>
    
    <div class="form-group">
        <label for="añogestion">{{ 'Año' }}</label>
        <select name="añogestion"  value="" class="form-control" id="añogestion">
            <option value="{{$anho['actual']}}">{{$anho['actual']}}</option>
            <option value="{{$anho['siguiente']}}">{{$anho['siguiente']}}</option>
    </select>
    </div>

    <div class="form-group">
        <label for="estaactivo" class="control-label">Estado</label>
        <input class="form-control" type="text" name="estaactivo" id="estaactivo" value="Activo" required readonly>
    </div>
    
    


    <br/>
    <input class="btn btn-success" type="submit" value="Guardar">
    <input class="btn btn-primary" type="reset" value="Limpiar campos">
    <a class="btn btn-danger" href="{{url('gestion')}}">Cancelar</a>


    </form>



</div>
@endsection