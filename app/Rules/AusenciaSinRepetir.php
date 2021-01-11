<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Ausencia;

class AusenciaSinRepetir implements Rule
{
        private $usuario;
        private $fecha;
        private $hora;
        
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($usuario,$fecha,$hora)
    {
        $this->usuario = $usuario;
        $this->fecha = $fecha;
        $this->hora = $hora;
        
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

       if(Ausencia::where('user_id',$this->usuario)->where('fechaausencia',$this->fecha)->where('horaausencia',$this->hora)->exists()){
           $res = false; 

       } else {

            $res = true;
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
        return 'No se puede repetir este permiso. Elija otra fecha y hora.';
    }
}
