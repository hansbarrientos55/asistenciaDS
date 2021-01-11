<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Asistencia;

class AsistenciaActualizar implements Rule
{
        private $usuario;
        private $materia;
        private $grupo;
        private $horario;
        private $fecha;
        private $asistencia;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($usuario,$materia,$grupo,$horario,$fecha,$asistencia)
    {
        $this->usuario = $usuario;
        $this->materia = $materia;
        $this->grupo =  $grupo;
        $this->horario = $horario;
        $this->fecha = $fecha;
        $this->asistencia = $asistencia;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $res;

       if(Asistencia::where('user_id',$this->usuario)->where('materia',$this->materia)->where('grupo',$this->grupo)->where('horario',$this->horario)->where('fecha',$this->fecha)->where('id',$this->asistencia)->exists()){
           $res = true; 

       } else {
           
            if(Asistencia::where('user_id',$this->usuario)->where('materia',$this->materia)->where('grupo',$this->grupo)->where('horario',$this->horario)->where('fecha',$this->fecha)->exists()){
                $res = false;
           } else {
                $res = true;
           }  
       }

       return $res;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La asistencia para esta fecha ya existe';
    }
}
