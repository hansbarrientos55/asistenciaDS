<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Horario;

class HorarioSinRepetir implements Rule
{
    
    private $grupo;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($grupo)
    {
        $this->grupo = $grupo;
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

       if(Horario::where('titulo',$value)->where('grupo_id',$this->grupo)->exists()){
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
        return 'El horario ya existe para este grupo.';
    }
}
