@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" ></h1>

<form action="{{url('/reposicionlista/update/'.$repos->id)}}"  class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    

    <label for="">Editar reposicion</label>
    <br/>

    <div class="form-group">
        <label for="fecha" class="control-label">Fecha</label>
        <input class="form-control" type="text" name="fecha" id="fecha" value="{{$repos->fecha}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="hora" class="control-label">Hora</label>
        <input class="form-control" type="text" name="hora" id="hora" value="{{$repos->hora}}" required readonly>
    </div>

    <div class="form-group">
        <label for="nuevafecha" class="control-label">Nueva fecha</label>
        <input class="form-control" type="text" name="nuevafecha" id="nuevafecha" value="{{$repos->nuevafecha}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="horario" class="control-label">Nueva hora</label>
        <input class="form-control" type="text" name="horario" id="horario" value="{{$repos->horario}}" required readonly>
    </div>

    <div class="form-group">
        <label for="grupo" class="control-label">Grupo</label>
        <input class="form-control" type="text" name="grupo" id="grupo" value="{{$repos->grupo}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="materia" class="control-label">Materia</label>
        <input class="form-control" type="text" name="materia" id="materia" value="{{$repos->materia}}" required readonly>
    </div>

    @role('Jefe de Departamento')
        <div class="form-group">
            <label for="exampleFormControlSelect1" class="control-label">Estado de la reposicion</label>
            <select name="estado"  value="" class="form-control" id="estado">
                <option value="Esperando confirmacion">Esperando confirmacion</option>
                <option value="Autorizada">Autorizada</option>
                <option value="Rechazada">Rechazada</option>
    
        </select>
        </div>
        @endrole

    <input type="submit" class="btn btn-success" value="Guardar cambios">
    <a class="btn btn-danger" href="{{url('reposicionlista')}}">Cancelar</a>


</form>

</div>
</div>
</div>
</div>

</div>
@endsection