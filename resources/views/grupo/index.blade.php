Inicio
<br/>
Grupo
<br/>
<title>Administrar grupos</title>
<a href="{{url('grupo/create/'.$id)}}">Agregar grupo</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th>Id </th>
            <th>Numero</th>
            <th>Estado</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($grupos as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->numerogrupo}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                  
                <a href="{{ url('/horario/'.$item->id.'/index') }}">Ver horarios</a>    
                <a href="{{ url('/grupo/'.$item->id.'/edit') }}">Modificar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/grupo/delete/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

