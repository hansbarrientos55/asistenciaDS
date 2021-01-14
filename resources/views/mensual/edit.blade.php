@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar control mensual</h1>

<form action="{{url('/mensual/'.$asi->id)}}"  class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}

    @if($errors->first('vistobueno'))
                    <div class="alert alert-danger" role ="alert" >
                    <ul>
                            <li>{{ $errors->first('vistobueno')}} </li>
                    </ul>
                    </div>
                   @endif
    <div class="form-group">
        <label for="fecha" class="control-label">Fecha</label>
        <input class="form-control" type="text" name="fecha" id="fecha" value="{{$asi->fecha}}" required readonly>
    </div>  

    <div class="form-group">
        <label for="hora" class="control-label">Hora</label>
        <input class="form-control" type="text" name="hora" id="hora" value="{{$asi->hora}}" required readonly>
    </div>  

    @role('Director Academico')
    <div class="form-group">
        <label for="mes" class="control-label">Mes</label>
        <input class="form-control" type="string" name="mes" id="mes" value="{{ $asi->mes }}" required readonly>
    </div> 
    @endrole

    @role('Jefe de Departamento')
    <div class="form-group">
        <label for="mes" class="control-label">Mes</label>
        <select name="mes"  value="" class="form-control" id="mes">
            <option value="Enero">Enero</option>
            <option value="Febrero">Febrero</option>
            <option value="Marzo">Marzo</option>
            <option value="Abril">Abril</option>
            <option value="Mayo">Mayo</option>
            <option value="Junio">Junio</option>
            <option value="Julio">Julio</option>
            <option value="Agosto">Agosto</option>
            <option value="Septiembre">Septiembre</option>
            <option value="Octubre">Octubre</option>
            <option value="Noviembre">Noviembre</option>
            <option value="Diciembre">Diciembre</option>

    </select>
    </div>
    @endrole


    @role('Director Academico')
    <div class="form-group">
        <label for="user_id">Usuario</label>
        <input class="form-control" type="string" name="user_id" id="user_id" value="{{ $asi->user_id }}" required readonly>
        </div>
        @endrole

        @role('Jefe de Departamento')
        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select name="user_id" class="form-control" id="user_id">
                @foreach ($usuarios as $item)
                    <option value="{{$item->id}}">{{$item->nombres.' '.$item->apellidos}}</option>
                @endforeach
            </select>
            </div>
            @endrole

        @role('Jefe de Departamento')
        <div class="form-group">
            <label for="vistobueno">Visto Bueno</label>
            <input class="form-control" type="string" name="vistobueno" id="vistobueno" value="{{ $asi->vistobueno }}" required readonly>
            </div>
            @endrole
    

            @role('Director Academico')
    <div class="form-group">
        <label for="vistobueno" class="control-label">Visto Bueno</label>
        <select name="vistobueno"  value="{{ $asi->vistobueno }}" class="form-control" id="vistobueno">
            <option value="Pendiente">Pendiente</option>
            <option value="Aceptado">Aceptado</option>

    </select>
    </div>
    @endrole

    <div class="form-group">
        <label for="firma" class="control-label">Firma</label>
        <input class="form-control" type="text" name="firma" id="firma" value="{{$asi->firma}}" required>
    </div>  
    <input type="submit" class="btn btn-success" value="Guardar">
    <a class="btn btn-danger" href="{{url('mensual')}}">Cancelar</a>

</form>

</div>
</div>
</div>
</div>

</div>
@endsection