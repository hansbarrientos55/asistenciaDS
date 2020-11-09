<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\User;

class UserImport implements ToModel, WithHeadingRow, WithValidation
{
     private $numRows = 0;
    
    
     public function model(array $row)
     {
             ++$this->numRows;
             return new User([
                 'nombres' => $row['nombres'],
                 'apellidos' => $row['apellidos'],
                 'cedula' => $row['cedula'],
                 //'fechanacimiento' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechanacimiento']),
                 'fechanacimiento' => $row['fechanacimiento'],
                 'direccion' => $row['direccion'],
                 'profesion' => $row['profesion'],
                 'username' => $row['username'],
                 'contrasenia' => $row['contrasenia'],
                 'password' => $row['password'],
                 'emailprincipal' => $row['emailprincipal'],
                 'emailsecundario' => $row['emailsecundario'],
                 'telefonoprincipal' => $row['telefonoprincipal'],
                 'telefonosecundario' => $row['telefonosecundario'],
                 'estaactivo' => $row['estaactivo'],
                 'rolprimario' => $row['rolprimario'],
                 'rolsecundario' => $row['rolsecundario'],
                 'rolprimariotexto' => $row['rolprimariotexto'],
                 'rolsecundariotexto' => $row['rolsecundariotexto']
             ]);
  
     }
  
     public function rules(): array
     {
         return [
             'nombres' => 'required',
             'apellidos' => 'required',
             'cedula' => 'required',
             'fechanacimiento' => 'required',
             'direccion' => 'required',
             'profesion' => 'required',
             'username' => 'required',

         ];
     }
  
     public function getRowCount(): int
     {
         return $this->numRows;
     }
}
