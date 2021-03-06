@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar facultad</h1>
<form action="{{url('/facultad/'.$facu->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="nombrefacu" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" type="text" name="nombrefacu" id="nombrefacu" value="{{$facu->nombrefacu}}" required>
    @if($errors->first('nombrefacu'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
               <li>{{ $errors->first('nombrefacu')}} </li>
      </ul>
    </div>
    @endif
    <br/>
    <label for="descripcionfacu" class="control-label">{{ 'Descripcion' }}</label>
    <input class="form-control" type="text" name="descripcionfacu" id="descripcionfacu" value="{{$facu->descripcionfacu}}" required>
    @if($errors->first('descripcionfacu'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
               <li>{{ $errors->first('descripcionfacu')}} </li>
      </ul>
    </div>
    @endif
    <br/>
    

    <div class="form-group">
        <label for="estaactivo" class="control-label">Estado</label>
        <input class="form-control" type="text" name="estaactivo" id="estaactivo" value="{{$facu->estaactivo}}" required readonly>
    </div>

    <input type="submit" class="btn btn-success" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('facultad')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection