<?php

namespace Lab;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    //
    /**
     * Obtiene el elemento (material, reactivo, equipo) al que pertenece el mantenimiento.
     */
    public function elemento()
    {
        return $this->belongsTo('App\Elemento');
    }
}
