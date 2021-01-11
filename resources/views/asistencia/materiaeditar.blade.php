@extends('layouts.principal')

@section('content')

<div class="container">

    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="width: 24rem; background-color: #a3bcc9;">
                <h1 class="text-center" style="font-family: Arial;font-size: 25px;color: rgb(0, 0, 0);" >Editar asistencia</h1>

                <form action="{{url('asistenciagrupoeditar/'.$asi->id)}}" class= "form-horizontal" style="font-family: Arial;color: rgb(0, 0, 0);" method="post"  enctype="multipart/form-data">
                    @csrf

                    <input class="form-control" type="string" name="llave" id="llave" value="{{$asi->id}}" required hidden>
                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Materia</label>
                        <select name="materia" class="form-control" id="materia">
                            @foreach ($materias as $lista)
                                @foreach($lista as $item)
                                    <option value="{{$item->id}}">{{$item->nombremate}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>


                    <input type="submit" class="btn btn-success" value="Siguiente">
                    <a class="btn btn-danger" href="{{url('asistencia')}}">Cancelar</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection