Crear facultad

<form action="{{ url('/facultad') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <label for="nombrefacu">{{ 'Nombre' }}</label>
    <input type="text" name="nombrefacu" id="nombrefacu" value="">
    <br/>
    <label for="descripciondfacu">{{ 'Descripcion' }}</label>
    <input type="text" name="descripcionfacu" id="descripcionfacu" value="">
    <br/>
    



    <br/>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
    <a href="{{url('facultad')}}">Cancelar</a>


</form>