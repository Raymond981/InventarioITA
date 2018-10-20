<?php

namespace Lab;

use Illuminate\Database\Eloquent\Model;

class Riesgo extends Model
{
    //
    /**
     * Obtiene el elemento (material, reactivo, equipo) al que pertenece el riesgo
     */
    public function elemento()
    {
        return $this->belongsTo('App\Elemento');
    }
}