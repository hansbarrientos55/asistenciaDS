<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Gestion;

class GestionSinRepetir implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

       if(Gestion::where('gestion',$value)->exists()){
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
        return 'Esta gestion ya existe.';
    }
}
