@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar reposicion</h1>

<form action="{{url('/reposicion/update/'.$repo->id)}}"  class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    @if($errors->first('estado'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
                <li>{{ $errors->first('estado')}} </li>
      </ul>
    </div>
   
    @endif 
    <div class="form-group">
        <label for="fecha" class="control-label">Fecha</label>
        <input class="form-control" type="text" name="fecha" id="fecha" value="{{$repo->fecha}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="hora" class="control-label">Hora</label>
        <input class="form-control" type="text" name="hora" id="hora" value="{{$repo->hora}}" required readonly>
    </div>  

    @if($errors->first('nuevafecha'))
          <div class="alert alert-danger" role ="alert" >
            <ul>
                      <li>{{ $errors->first('nuevafecha')}} </li>
            </ul>
          </div>
         
          @endif 
    <div class="form-group">
        <label for="nuevafecha" class="control-label">{{ 'Nueva fecha' }}</label>
        <input class="form-control" type="date" name="nuevafecha" id="nuevafecha" value="" required>
        </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Nuevo horario</label>
        <select name="horario" class="form-control" id="horario">
            @foreach ($horarios as $item)
                <option value="{{$item->hora}}">{{$item->hora}}</option>
            @endforeach
        </select>
    </div>

    
      
    
    <input type="submit" class="btn btn-success" value="Guardar">
    <a class="btn btn-danger" href="{{url('ausencia')}}">Cancelar</a>

</form>

</div>
</div>
</div>
</div>

</div>
@endsection