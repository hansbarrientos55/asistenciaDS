@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">


    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Nuevo permiso</h1>

    <form action="{{url('ausencia/store')}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="fecha" class="control-label">Fecha</label>
        <input class="form-control" type="string" name="fecha" id="fecha" value="{{$fecha}}" required readonly>
        </div>  
    
        <div class="form-group">
            <label for="hora" class="control-label">Hora</label>
            <input class="form-control" type="string" name="hora" id="hora" value="{{ $hora }}" required readonly>
        </div>

        <div class="form-group">
            <label for="motivo" class="control-label">Motivo</label>
            <input class="form-control" type="text" name="motivo" id="motivo" value="" required>
        </div> 

        <div class="form-group">
            <label for="fechaausencia" class="control-label">Fecha de ausencia</label>
        <input class="form-control" type="date" name="fechaausencia" id="fechaausencia" value="" required>
        </div>  
    
        <div class="form-group">
            <label for="horaausencia">Hora de ausencia</label>
            <select name="horaausencia" class="form-control" id="horaausencia">
                @foreach ($horas as $item)
                    <option value="{{$item->hora}}">{{$item->hora}}</option>
                @endforeach
            </select>
        </div>

        @role('Docente')
        <div class="form-group">
            <label for="estaaceptada" class="control-label">Estado del permiso</label>
            <input class="form-control" type="text" name="estaaceptada" id="estaaceptada" value="Esperando confirmacion" readonly required>
        </div> 
        @endrole

        <div class="form-group">
            <label for="archivo" class="control-label">Archivo</label>
            <input class="form-control" type="file" name="archivo" id="archivo" value="">
        </div> 


        <button class="btn btn-primary" type="submit">Guardar</button>
        <a class="btn btn-danger" href="{{url('ausencia')}}">Cancelar</a>

    </form>
</div>
</div>
</div>
</div>

</div>
@endsection