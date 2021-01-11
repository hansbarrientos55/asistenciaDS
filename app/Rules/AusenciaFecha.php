<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Ausencia;
use Carbon\Carbon;

class AusenciaFecha implements Rule
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
        $ahora = Carbon::now()->format('Y-m-d');
        $res;

        if($value < $ahora){
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
        return 'La fecha no puede ser anterior a hoy.';
    }
}
