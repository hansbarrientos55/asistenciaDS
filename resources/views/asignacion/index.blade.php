
    <h1 class="text-center">Lista de Asignaciones de Docentes</h1>

    <a href="{{url('asignacion/create')}}">Asignar materia a docente</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Gestion</th>
            <th scope="col">Departamento</th>
            <th scope="col">Docente</th>
            <th scope="col">Materia</th>
            <th scope="col">Grupo</th>
            <th scope="col">Horario</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($asignaciones as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->gestion}}</td>
                <td>{{$item->departamento}}</td>
                <td>{{$item->docente}}</td>
                <td>{{$item->materia}}</td>
                <td>{{$item->grupo}}</td>
                <td>{{$item->horario}}</td>
                <td>
                    <a href="{{ url('/asignacion/'.$item->id.'/edit') }}">Modificar</a>
                    
                    
                    | Archivar | Desarchivar |

                <form action="{{ url('/asignacion/'.$item->id) }}" method="post">
                     {{ csrf_field() }}   
                     {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Eliminar ?');" >Eliminar</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
