<title>Asignacion de Materia-Grupo-Horario</title>
    <h1 class="text-center">Asignacion Grupo Materia</h1>
    <form action="{{url('asignacion/store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlSelect1">Gestión</label>
            <select name="gestion" class="form-control" id="gestion">
                @foreach ($gestiones as $item)
                    <option value="{{$item->gestion}}">{{$item->gestion}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Departamento</label>
            <select name="departamento"  value="" class="form-control" id="departamento">
            @foreach ($departamentos as $item)
                <option value="{{$item->nombredepa}}">{{$item->nombredepa}}</option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Docente</label>
            <select name="docente" class="form-control" id="docente">
                @foreach ($docentes as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
        <label for="exampleFormControlSelect1">Materia</label>
        <select name="materia" class="form-control" id="materia">
            @foreach ($materias as $item)
                <option value="{{$item->nombremate}}">{{$item->nombremate}}</option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Grupo</label>
            <select name="grupo" class="form-control" id="grupo">
                @foreach ($grupos as $item)
                    <option value="{{$item->numerogrupo}}">{{$item->numerogrupo}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Horario</label>
            <select name="horario" class="form-control" id="horario">
                @foreach ($horarios as $item)
                    <option value="{{$item->id}}">{{$item->id}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary btn-block" type="submit">Guardar</button>
        <a href="{{url('asignacion')}}">Cancelar</a>
    </form>
