@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #006699;">


    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Nueva facultad</h2>

<form action="{{ url('/facultad') }}" class= "form-horizontal" style="font-family: Arial;color: rgb(233,237,241);" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="form-group">
    <label for="nombrefacu" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" type="text" name="nombrefacu" id="nombrefacu" value="" required>
</div>  

    <div class="form-group">
    <label for="descripciondfacu" class="control-label">{{ 'Descripcion' }}</label>
    <input class="form-control" type="text" name="descripcionfacu" id="descripcionfacu" value="" required>

</div>  




    <input type="submit" class="btn btn-success" value="Guardar">
    <input type="reset" class="btn btn-primary" value="Borrar">
    <a class="btn btn-danger" href="{{url('facultad')}}">Cancelar</a>

 
</form>

</div>
</div>
</div>
</div>

</div>
@endsection