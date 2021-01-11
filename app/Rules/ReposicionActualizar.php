<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Reposicion;

class ReposicionActualizar implements Rule
{
        private $ausencia;
        private $fecha;
        private $hora;
        private $reposicion;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ausencia,$fecha,$hora,$reposicion)
    {
        $this->ausencia = $ausencia;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->reposicion = $reposicion;
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

       if(Reposicion::where('ausencia_id',$this->ausencia)->where('nuevafecha',$this->fecha)->where('horario',$this->hora)->where('id',$this->reposicion)->exists()){
           $res = true; 

       } else {
           
            if(Reposicion::where('ausencia_id',$this->ausencia)->where('nuevafecha',$this->fecha)->where('horario',$this->hora)->exists()){
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
        return 'No se puede repetir esta reposicion';
    }
}
