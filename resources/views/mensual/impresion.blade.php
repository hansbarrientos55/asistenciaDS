
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PRUEBA PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>

<h2 style="text-align:center">Parte Mensual de Asistencia</h2>

     <div class="container">
         <table class="table">
             <tr>
                 <td>Facultad:</td>
                 <td>Tecnología</td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>Departamento</td>
                 <td>Informatica y Sistemas</td>
             </tr>
             <tr>
                 <td>Gestión:</td>
                 <td>1-2021</td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>Periodo:</td>
                 <td>15/01/2021 al 15/02/21</td>
             </tr>
             <tr>
                 <td>Horas Pagables Departamento</td>
                 <td>{{$pagables}}</td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>Horas No Pagables Departamento:</td>
                 <td>{{$nopagables}}</td>
             </tr>

         </table>
     </div>

 <div class="container-fluid">
     <table class="table table-striped table-bordered text-center ">
         <thead class="thead-dark" >
             <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Horas asignadas</th>
                <th scope="col">Horas trabajadas</th>
                <th scope="col">Faltas (Horas)</th>
                <th scope="col">Licencias (Horas)</th>
                <th scope="col">Bajas (Horas)</th>
                <th scope="col">Comision (Horas)</th>
                <th scope="col">Total Horas Pagables</th>

             </tr>
         </thead>
         <tbody >

             @foreach ($reportes as $item)
             <tr>
                <td>{{$item->usuario}}</td>
                <td>{{$item->horas}}</td>
                <td>{{$item->asistidas}}</td>
                <td>{{$item->faltas}}</td>
                <td>{{$item->licencia}}</td>
                <td>{{$item->baja}}</td>
                <td>{{$item->comision}}</td>
                <td>{{$item->totalpagables}}</td>
             </tr>
             @endforeach

         </tbody>
     </table>
 </div>

</body>
</html>






