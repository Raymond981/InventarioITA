<?php

namespace Lab;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    //
    /**
     * Obtener los riesgos para el elemento.
     */
    public function riesgos()
    {
        return $this->hasMany('App\Riesgo');
    }

    /**
     * Obtener los mantenimientos para el elemento
     */
    public function mantenimientos()
    {
        return $this->hasMany('App\Mantenimiento');
    }

    /** guardar una relación en el controlador
         * $ship = new Ship;
         *$ship->name = 'Enterprise';
        *$ship->registry = 'ncc-1701D';
        *
        *$ship->save();
        *
        *Then for the relation;
        *$captain = new Captain;
        *
        *$captain->name = 'jean Luc Picard';
        *
        *$ship->captain()->save($captain);
     */
}
