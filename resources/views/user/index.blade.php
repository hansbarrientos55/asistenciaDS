Inicio
<br/>
Usuarios
<br/>
<title>Administracion de usuarios</title>
@if (Session::has('mensaje')){{
    Session::get('mensaje')
}}
    
@endif


<a href="{{url('user/create')}}">Agregar usuario</a>


<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <th> Id </th>
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
        @foreach ($users as $item)
            
        
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombres}}</td>
                <td>{{$item->apellidos}}</td>
                <td>{{$item->cedula}}</td>
                <td>{{$item->fechanacimiento}}</td>
                <td>{{$item->direccion}}</td>
                <td>{{$item->profesion}}</td>
                <td>{{$item->username}}</td>
                <td>{{$item->contraseña}}</td>
                <td>{{$item->estaactivo}}</td>
                <td> 
                    
                <a href="{{ url('/user/'.$item->id.'/edit') }}">Editar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/user/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>


                </td>
                
            </tr>
         @endforeach

        
    </tbody>
</table>

