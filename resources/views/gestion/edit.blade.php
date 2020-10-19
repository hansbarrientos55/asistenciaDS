Editar gestion
<title>Editar gestion</title>
<form action="{{url('/gestion/'.$ges->id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
    <label for="periodogestion">{{ 'Periodo' }}</label>
<input type="text" name="periodogestion" id="periodogestion" value="{{$ges->periodogestion}}" required>
    <br/>
    <label for="añogestion">{{ 'Año' }}</label>
    <input type="text" name="añogestion" id="añogestion" value="{{$ges->añogestion}}" required>
    <br/>
    

    <input type="submit" value="Guardar cambios">
    <a href="{{url('gestion')}}">Cancelar</a>


</form>