Inicio
<br/>
Grupo
<br/>

<a href="{{url('grupo/create')}}">Agregar grupo</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th> # </th>
            <th>Numero</th>
            <th>Estado</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($grupos as $item)
            
        
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->numerogrupo}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a href="{{ url('/grupo/'.$item->id.'/edit') }}">Modificar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/grupo/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

