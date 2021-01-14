<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Mensual;

class MensualActualizar implements Rule
{
    private $mes;
    private $usuario;
    private $mensual;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($mes, $usuario,$mensual)
    {
        $this->mes = $mes;
        $this->usuario = $usuario;
        $this->mensual = $mensual;
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

       if(Mensual::where('user_id',$this->usuario)->where('mes',$this->mes)->where('id',$this->mensual)->exists()){
           $res = true; 

       } else {
           
            if(Mensual::where('user_id',$this->usuario)->where('mes',$this->mes)->exists()){
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
        return 'Ya existe un informe mensual registrado para otro usuario';
    }
}
