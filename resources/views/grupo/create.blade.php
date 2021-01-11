@extends('layouts.principal')

@section('content')

<div class="container">
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nuevo grupo</h2>

<form action="{{ url('/grupo/store/'.$id) }}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="numerogrupo" class="control-label">{{ 'Numero' }}</label>
    <input class="form-control" type="text" name="numerogrupo" id="numerogrupo" value="{{ old('numerogrupo') }}" required>
    @if($errors->first('numerogrupo'))
     <div class="alert alert-danger" role ="alert" >
       <ul>
                <li>{{ $errors->first('numerogrupo')}} </li>
       </ul>
     </div>
     @endif
    <br/>  

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
    <a class="btn btn-danger" href="{{ url('/grupo/'.$id.'/index') }}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>


</div>
@endsection