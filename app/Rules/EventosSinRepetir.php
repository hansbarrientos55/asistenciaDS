<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Event;

class EventosSinRepetir implements Rule
{
    
    private $creador;
    private $tipo;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($creador, $tipo)
    {
        $this->creador = $creador;
        $this->tipo = $tipo;
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

       if(Event::where('title',$value)->where('creator',$this->creador)->where('type',$this->tipo)->exists()){
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
        return 'El evento ya existe en el calendario';
    }
}
