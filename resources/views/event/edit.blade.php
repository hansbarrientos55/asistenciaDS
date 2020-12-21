@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar evento</h1>

<form action="{{url('/event/edit/'.$evento->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <label for="title" class="control-label">{{ 'Titulo' }}</label>
    <input class="form-control" type="text" name="title" id="title" value="{{$evento->title}}" required>
    <br/>
    <label for="start" class="control-label">{{ 'Fecha de inicio' }}</label>
    <input class="form-control" type="date" name="start" id="start" value="{{$evento->start}}" required>
    <br/>
    <label for="end" class="control-label">{{ 'Fecha de finalizacion' }}</label>
    <input class="form-control" type="date" name="end" id="end" value="{{$evento->end}}" required>
    <br/>
    <label> Tipo </label>  
    <select name="type"  value="" class="form-control" id="type">
        @hasanyrole('Administrador|Jefe de Departamento')
        <option value="Global">Global</option>
        @endhasanyrole
        @hasanyrole('Docente|Jefe de Departamento')
        <option value="Personal">Personal</option>
        @endhasanyrole
    </select>   
    <br/>

    <input class="btn btn-success" type="submit" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('event')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection