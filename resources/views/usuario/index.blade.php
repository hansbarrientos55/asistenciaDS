Inicio
<br/>
Usuarios
<br/>

@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif


<a href="{{url('usuario/create')}}">Agregar usuario</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th> # </th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cedula de identidad</th>
            <th>Fecha de nacimiento</th>
            <th>Direccion</th>
            <th>Profesion</th>
            <th>Codigo SIS</th>
            <th>Contraseña</th>
            <th>Estado</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($usuarios as $item)
            
        
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nombres}}</td>
                <td>{{$item->apellidos}}</td>
                <td>{{$item->cedula}}</td>
                <td>{{$item->fechanacimiento}}</td>
                <td>{{$item->direccion}}</td>
                <td>{{$item->profesion}}</td>
                <td>{{$item->codigosis}}</td>
                <td>{{$item->contraseña}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a href="{{ url('/usuario/'.$item->id.'/edit') }}">Modificar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/usuario/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

