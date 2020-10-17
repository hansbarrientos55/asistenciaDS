
    <h1 class="text-center">Asignacion Grupo Materia</h1>
    <form action="{{url('asignacion/store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlSelect1">Gestión</label>
            <select name="gestion" class="form-control" id="departamento_id">
                @foreach ($gestiones as $item)
                    <option value="{{$item->añogestion}}">{{$item->añogestion}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Departamento</label>
            <select name="departamento"  value="" class="form-control" id="departamento_id">
            @foreach ($departamentos as $item)
                <option value="{{$item->nombredepa}}">{{$item->nombredepa}}</option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Docente</label>
            <select name="docente" class="form-control" id="departamento_id">
                @foreach ($docentes as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
        <label for="exampleFormControlSelect1">Materia</label>
        <select name="materia" class="form-control" id="departamento_id">
            @foreach ($materias as $item)
                <option value="{{$item->nombremate}}">{{$item->nombremate}}</option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Grupo</label>
            <select name="grupo" class="form-control" id="departamento_id">
                @foreach ($grupos as $item)
                    <option value="{{$item->numerogrupo}}">{{$item->numerogrupo}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Horario</label>
            <select name="horario" class="form-control" id="exampleFormControlSelect1">
            <option>6.45 am</option>
            <option>8.15 am</option>
            <option>12.45 pm</option>
            <option>14.15 pm</option>
            <option>15.45 pm</option>
            </select>
        </div>

        <button class="btn btn-primary btn-block" type="submit">Guardar</button>
        <a href="{{url('asignacion')}}">Cancelar</a>
    </form>
