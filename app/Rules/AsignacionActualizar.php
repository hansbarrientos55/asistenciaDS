<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Asignacion;

class AsignacionActualizar implements Rule
{
    private $gestion;
    private $materia;
    private $grupo;
    private $docente;
    private $asignacion;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ges,$mat,$gru,$doc,$lla)
    {
        $this->gestion = $ges;
        $this->materia = $mat;
        $this->grupo = $gru;
        $this->docente = $doc;
        $this->asignacion = $lla;
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

       if(Asignacion::where('gestion',$this->gestion)->where('materia',$this->materia)->where('grupo',$this->grupo)->where('docente',$this->docente)->where('id',$this->asignacion)->exists()){
            $res = true;

       } else {
             
        if(Asignacion::where('gestion',$this->gestion)->where('materia',$this->materia)->where('grupo',$this->grupo)->exists()){
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
        return 'La asignacion de esta Materia, con Grupo y Horario para este docente ya esta registrada. Ingrese otra.';
    }
}
