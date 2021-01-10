@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nuevo departamento</h2>

<form action="{{ url('/departamento') }}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombredepa">{{ 'Nombre' }}</label>
    <input class="form-control" type="text" name="nombredepa" id="nombredepa" value="{{ old('nombredepa') }}" required>
    @if($errors->first('nombredepa'))
     <div class="alert alert-danger" role ="alert" >
       <ul>
                <li>{{ $errors->first('nombredepa')}} </li>
       </ul>
     </div>
     @endif
    <br/>
    <label for="descripciondepa">{{ 'Descripcion' }}</label>
    <input class="form-control" type="text" name="descripciondepa" id="descripciondepa" value="{{ old('descripciondepa') }}" required>
    @if($errors->first('descripciondepa'))
     <div class="alert alert-danger" role ="alert" >
       <ul>
                <li>{{ $errors->first('descripciondepa')}} </li>
       </ul>
     </div>
     @endif
    <br/>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Facultad</label>
        <select name="facultad_id"  value="" class="form-control" id="facultad_id">
        @foreach ($facultades as $item)
            <option value="{{$item->id}}">{{$item->id.' - '.$item->nombrefacu}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
        <label for="estaactivo" class="control-label">Estado</label>
        <input class="form-control" type="text" name="estaactivo" id="estaactivo" value="Activo" required readonly>
    </div>



    <br/>
    <input type="submit" class="btn btn-success" value="Guardar">
    <input type="reset" class="btn btn-primary" value="Limpiar campos">
    <a class="btn btn-danger" href="{{url('departamento')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection