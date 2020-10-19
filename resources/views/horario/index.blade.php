Inicio
<br/>
Horario
<br/>
<title>Administrar horarios</title>
<a href="{{url('horario/create/'.$id)}}">Agregar horario</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th> Id </th>
            <th>Hora</th>
            <th>Dia</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($horarios as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->hora}}</td>
                <td>{{$item->dia}}</td>
                <td> 
                    
                <a href="{{ url('/horario/'.$item->id.'/edit') }}">Modificar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/horario/delete/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                    
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

