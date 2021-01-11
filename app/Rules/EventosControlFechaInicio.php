<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Event;
use Carbon\Carbon;

class EventosControlFechaInicio implements Rule
{
    private $inicio;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($inicio)
    {
        $this->inicio = $inicio;
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

        if($this->inicio < $ahora){
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
        return 'La fecha inicial no puede definirse antes del dia de hoy';
    }
}
