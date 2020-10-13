
    <h1 class="text-center">Lista de Asignaciones de Docentes</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#Id</th>
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
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
