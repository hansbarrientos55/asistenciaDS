@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nueva carrera</h2>

<form action="{{ url('/carrera') }}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombrecarrera" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" type="text" name="nombrecarrera" id="nombrecarrera" value="{{ old('nombrecarrera') }}" required>
    @if($errors->first('nombrecarrera'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
               <li>{{ $errors->first('nombrecarrera')}} </li>
      </ul>
    </div>
    @endif
    <br/>
    <label for="codigocarrera" class="control-label">{{ 'Codigo' }}</label>
    <input class="form-control" type="text" name="codigocarrera" id="codigocarrera" value="{{ old('codigocarrera') }}" required>
    @if($errors->first('codigocarrera'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
               <li>{{ $errors->first('codigocarrera')}} </li>
      </ul>
    </div>
    @endif
    <br/>
    <label for="descripcioncarrera" class="control-label">{{ 'Descripcion' }}</label>
    <input class="form-control" type="text" name="descripcioncarrera" id="descripcioncarrera" value="{{ old('descripcioncarrera') }}" required>
    @if($errors->first('descripcioncarrera'))
    <div class="alert alert-danger" role ="alert" >
      <ul>
               <li>{{ $errors->first('descripcioncarrera')}} </li>
      </ul>
    </div>
    @endif
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Facultad</label>
        <select name="facultad_id"  value="" class="form-control" id="facultad_id">
        @foreach ($facultades as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->nombrefacu}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1" class="control-label">Estado</label>
        <select name="estaactivo"  value="" class="form-control" id="estaactivo">
            <option value="Activo">Activo</option>
            <option value="Archivado">Archivado</option>

    </select>
    </div>



    <br/>
    <input class="btn btn-success" type="submit" value="Guardar">
    <input class="btn btn-primary" type="reset" value="Limpiar campos">
    <a class="btn btn-danger" href="{{url('carrera')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection