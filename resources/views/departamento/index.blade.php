Inicio
<br/>
Departamentos
<br/>
<title>Administrar departamentos</title>
<a href="{{url('departamento/create')}}">Agregar departamento</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th>Id </th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($departamentos as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombredepa}}</td>
                <td>{{$item->descripciondepa}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a href="{{ url('/departamento/'.$item->id.'/edit') }}">Editar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/departamento/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

