Crear horario
<title>Crear horario</title>
<form action="{{ url('/horario/store/'.$id) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="form-group">
    <label for="exampleFormControlSelect1">Hora</label>
    <select name="hora" class="form-control" id="grupo_id">
        @foreach ($horas as $item)
            <option value="{{$item->hora}}">{{$item->hora}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Dia</label>
    <select name="dia"  value="" class="form-control" id="grupo_id">
    @foreach ($dias as $item)
        <option value="{{$item->dia}}">{{$item->dia}}</option>
    @endforeach
</select>
</div>
    
    


    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('materia')}}">Cancelar</a>


</form>