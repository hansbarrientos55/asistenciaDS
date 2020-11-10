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
                 'fechanacimiento' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechanacimiento']),
                 //'fechanacimiento' => $row['fechanacimiento'],
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
                 'rolsecundario' => $row['rolsecundario']
             ]);
  
     }
  
     public function rules(): array
     {
         return [
            'nombres' => 'required',
            'apellidos' => 'required',
            'cedula' => ['required', 'unique:users'],
            'fechanacimiento' => 'required',
            'direccion' => 'required',
            'profesion' => 'required',
            'username' => ['required', 'unique:users'],
            'contrasenia' => 'required',
            'password' => 'required',
            'emailprincipal' => ['required', 'unique:users'],
            'emailsecundario' => 'required',
            'telefonoprincipal' => ['required', 'unique:users'],
            'telefonosecundario' => 'required',
            'estaactivo' => 'required',
            'rolprimario' => 'required',
            'rolsecundario' => 'required'
         ];
     }

     public function customValidationMessages()
    {
        return [
            //mensajes de alerta, para evitar datos NULL
            'nombres.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'apellidos.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'cedula.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'fechanacimiento.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'direccion.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'profesion.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'username.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'contrasenia.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'password.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'emailprincipal.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'emailsecundario.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'telefonoprincipal.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'telefonosecundario.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'estaactivo.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'rolprimario.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            'rolsecundario.required' => 'Se encontro un dato vacio en :attribute, fila :row, no se añadio a nuestros registros por que el sistema no acepta datos NULL',
            
            //mensajes de alerta, para evitar duplicación de datos
            'cedula.unique' => 'No podemos añadir la :attribute de la fila :row, porque ya existe en nuestros registros',
            'username.unique' => 'No podemos añadir el :attribute de la fila :row, porque ya existe en nuestros registros',
            'emailprincipal.unique' => 'No podemos añadir el :attribute de la fila :row, porque ya existe en nuestros registros',
            'telefonoprincipal.unique' => 'No podemos añadir el :attribute de la fila :row, porque ya existe en nuestros registros',

        ];
    }
  
     public function getRowCount(): int
     {
         return $this->numRows;
     }
}
