Inicio
<br/>
Facultad
<br/>

<a href="{{url('facultad/create')}}">Agregar facultad</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th> # </th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($facultades as $item)
            
        
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nombrefacu}}</td>
                <td>{{$item->descripcionfacu}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a href="{{ url('/facultad/'.$item->id.'/edit') }}">Modificar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/facultad/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

