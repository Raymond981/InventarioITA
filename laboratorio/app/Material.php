<?php

namespace Lab;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //Tablas donde hacen referencias
    protected $table = 'materiales';

    protected $primaryKey = "idmateriales";

    public $timestamps = false;

    protected $fillable =[
    	'nombre_material',
    	'descripcion_material',
    	'stock_material',
        'capacidad_material',
        'observaciones_material',
    	'condicion'
    ];

    protected $guarded = [
    	
    ];
}
