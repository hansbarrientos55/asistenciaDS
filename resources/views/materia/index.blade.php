Inicio
<br/>
Materia
<br/>
<title>Administracion de Materias</title>
<a href="{{url('materia/create')}}">Agregar materia</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th>Id</th>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Nivel</th>
            <th>Activo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($materias as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombremate}}</td>
                <td>{{$item->codigomate}}</td>
                <td>{{$item->descripcionmate}}</td>
                <td>{{$item->nivelmate}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a href="{{ url('/grupo/'.$item->id.'/index') }}">Ver grupos</a>    
                <a href="{{ url('/materia/'.$item->id.'/edit') }}">Editar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/materia/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

