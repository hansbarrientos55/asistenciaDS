@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nuevo horario</h2>

<form action="{{ url('/horario/store/'.$id) }}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
{{ csrf_field() }}

@if($errors->first('titulo'))
     <div class="alert alert-danger" role ="alert" >
       <ul>
                <li>{{ $errors->first('titulo')}} </li>
       </ul>
     </div>
     @endif

<div class="form-group">
    <label for="exampleFormControlSelect1" class="control-label">Hora</label>
    <select name="hora" class="form-control" id="grupo_id">
        @foreach ($horas as $item)
            <option value="{{$item->hora}}">{{$item->hora}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleFormControlSelect1" class="control-label">Dia</label>
    <select name="dia"  value="" class="form-control" id="grupo_id">
    @foreach ($dias as $item)
        <option value="{{$item->dia}}">{{$item->dia}}</option>
    @endforeach
</select>
</div>
    
<div class="form-group">
    <input class="form-control" type="text" name="titulo" id="titulo" value="" hidden>
</div>
    


    <br/>
    <input class="btn btn-success" type="submit" value="Guardar">
    <input class="btn btn-primary" type="reset" value="Limpiar campos">
    <a class="btn btn-danger" href="{{ url()->previous() }}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>



</div>
@endsection