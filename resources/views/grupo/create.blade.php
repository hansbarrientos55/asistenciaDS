@extends('layouts.principal')

@section('content')

<div class="container">
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #006699;">

    <h2 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(233,237,241);" >Nuevo grupo</h2>

<form action="{{ url('/grupo/store/'.$id) }}" class= "form-horizontal" style="font-family: Arial;color: rgb(233,237,241);" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="numerogrupo" class="control-label">{{ 'Numero' }}</label>
    <input class="form-control" type="text" name="numerogrupo" id="numerogrupo" value="" required>
    <br/>  



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