<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Ausencia;

class AusenciaActualizar implements Rule
{
        private $usuario;
        private $fecha;
        private $hora;
        private $ausencia;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($usuario,$fecha,$hora,$ausencia)
    {
        $this->usuario = $usuario;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->ausencia = $ausencia;
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

       if(Ausencia::where('user_id',$this->usuario)->where('fechaausencia',$this->fecha)->where('horaausencia',$this->hora)->where('id',$this->ausencia)->exists()){
           $res = true; 

       } else {
           
            if(Ausencia::where('user_id',$this->usuario)->where('fechaausencia',$this->fecha)->where('horaausencia',$this->hora)->exists()){
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
        return 'Ya se tiene registro de un permiso a la misma fecha y hora.';
    }
}
