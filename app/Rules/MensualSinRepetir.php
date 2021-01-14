<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Mensual;

class MensualSinRepetir implements Rule
{
    private $mes;
    private $usuario;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($mes, $usuario)
    {
        $this->mes = $mes;
        $this->usuario = $usuario;
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

       if(Mensual::where('user_id',$this->usuario)->where('mes',$this->mes)->exists()){
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
        return 'Ya existe un informe mensual actual para este usuario';
    }
}
