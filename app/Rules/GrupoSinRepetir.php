<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Grupo;

class GrupoSinRepetir implements Rule
{
    
    private $materia;
    
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($materia)
    {
        $this->materia = $materia;
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

       if(Grupo::where('numerogrupo',$value)->where('materia_id',$this->materia)->exists()){
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
        return 'El grupo ya existe para esta materia.';
    }
}
