@extends('layouts.principal')

@section('content')

<div class="container">


    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">

                    
    
    <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Elegir grupo</h1>

    <form action="{{url('asignacion/guardar')}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post"  enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label for="exampleFormControlSelect1">Gestión</label>
                <input class="form-control" type="text" name="gestion" id="gestion" value="{{$gestion}}" readonly required>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Departamento</label>
            <input class="form-control" type="text" name="departamento" id="departamento" value="{{$departamento}}" readonly required>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Docente</label>
            <input class="form-control" type="text" name="nomdocente" id="nomdocente" value="{{$nomdocente}}" readonly required>
            <input class="form-control" type="hidden" id="docente" name="docente" value="{{$docente}}">
        </div>

        <div class="form-group">
        <label for="materia">Materia</label>
        <input class="form-control" type="text" name="nommateria" id="nommateria" value="{{$nommateria}}" readonly required>
        <input class="form-control" type="hidden" id="materia" name="materia" value="{{$materia}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Grupo</label>
            <select name="grupo" class="form-control" id="grupo">
                @foreach ($grupos as $item)
                    <option value="{{$item->id}}">{{$item->numerogrupo}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary" type="submit">Guardar</button>
        <a class="btn btn-danger" href="{{url('asignaciones')}}">Cancelar</a>

    </form>
</div>
</div>
</div>
</div>



</div>
@endsection