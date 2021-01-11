<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Event;

class EventosControlFecha implements Rule
{
    private $inicio;
    private $fin;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($inicio, $fin)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;
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

        if($this->inicio > $this->fin){
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
        return 'La fecha final no puede estar antes de la inicial';
    }
}
