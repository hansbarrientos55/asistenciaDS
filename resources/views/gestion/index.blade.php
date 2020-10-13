Inicio
<br/>
Gestion
<br/>

<a href="{{url('gestion/create')}}">Agregar gestion</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th> # </th>
            <th>Periodo</th>
            <th>Año</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($gestiones as $item)
            
        
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->periodogestion}}</td>
                <td>{{$item->añogestion}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a href="{{ url('/gestion/'.$item->id.'/edit') }}">Modificar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/gestion/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

