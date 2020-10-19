Crear gestion
<title>Crear gestion</title>
<form action="{{ url('/gestion') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="periodogestion">{{ 'Periodo' }}</label>
    <input type="text" name="periodogestion" id="periodogestion" value="" required>
    <br/>
    <label for="añogestion">{{ 'Año' }}</label>
    <input type="text" name="añogestion" id="añogestion" value="" required>
    <br/>
    
    


    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('gestion')}}">Cancelar</a>


</form>