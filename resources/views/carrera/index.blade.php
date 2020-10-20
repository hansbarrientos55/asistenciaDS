Inicio
<br/>
Carrera
<br/>
<title>Administrar carreras</title>
<a href="{{url('carrera/create')}}">Agregar carrera</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th>Id </th>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($carreras as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombrecarrera}}</td>
                <td>{{$item->codigocarrera}}</td>
                <td>{{$item->descripcioncarrera}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a href="{{ url('/carrera/'.$item->id.'/edit') }}">Editar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/carrera/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

