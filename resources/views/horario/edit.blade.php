Editar horario
<title>Editar horario</title>
<form action="{{url('/horario/update/'.$id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
       
    <div class="form-group">
        <label for="exampleFormControlSelect1">Hora</label>
        <select name="hora" class="form-control" id="hora">
            @foreach ($horas as $item)
                <option value="{{$item->hora}}">{{$item->hora}}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="exampleFormControlSelect1">Dia</label>
        <select name="dia"  value="" class="form-control" id="dia">
        @foreach ($dias as $item)
            <option value="{{$item->dia}}">{{$item->dia}}</option>
        @endforeach
    </select>
    </div>


    <input type="submit" value="Guardar cambios">
    <a href="{{url('materia')}}">Cancelar</a>


</form>
