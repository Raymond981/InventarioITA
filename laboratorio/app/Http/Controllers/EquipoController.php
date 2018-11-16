<?php

namespace Lab\Http\Controllers;

use Illuminate\Http\Request;
use Lab\Elemento;
use Lab\Http\Resources\ElementoResource as Equipo;
use Carbon\Carbon;

class EquipoController extends Controller
{
    public function index()
    {
        $elemento = Elemento::orderBy('nombre', 'asc')->where('tipo','equipo')->where('eliminado','=',0)->get();
        return Equipo::collection($elemento);
    }


    public function store(Request $request)
    {   
        $elemento = new Elemento();
        $elemento->tipo = "equipo";
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->no_serie = $request->no_serie;
        $elemento->no_piezas = $request->no_piezas;
        $elemento->mantenimiento1 = Carbon::parse($request->mantenimiento1);
        $elemento->mantenimiento2 = Carbon::parse($request->mantenimiento2);
        $elemento->save();
        error_log($elemento);
       return new Equipo($elemento);
    }
 

    public function show($id)
    {
        $elemento = Elemento::findOrFail($id);
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->no_serie = $request->no_serie;
        $elemento->no_piezas = $request->no_piezas;
        $elemento->mantenimiento1 = Carbon::parse($request->mantenimiento1);
        $elemento->mantenimiento2 = Carbon::parse($request->mantenimiento2);
        return new Equipo($elemento);   
    }


    public function update(Request $request, $id)
    {
        $elemento = Elemento::findOrFail($id);
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->clase = null;
        $elemento->estado_fisico = null;
        $elemento->formula_quimica = null;
        $elemento->no_serie = $request->no_serie;
        $elemento->no_piezas = $request->no_piezas;
        $elemento->cantidad = null;
        $elemento->unidad_medida = null;

        $elemento->update();
    }

    public function destroy($id)
    {
        $elemento=Elemento::findOrFail($id);
        $elemento->eliminado=1;
        $elemento->update();
    }
}
