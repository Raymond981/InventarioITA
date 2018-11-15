<?php

namespace Lab\Http\Controllers;

use Illuminate\Http\Request;
use Lab\Elemento;
use Lab\Http\Resources\ElementoResource as Toto;

class EquipoController extends Controller
{
    public function index()
    {
        $elemento = Elemento::orderBy('nombre', 'desc')->where('tipo','equipo')->where('eliminado','=',0)->paginate(12);
        return Toto::collection($elemento);
    }


    public function store(Request $request)
    {
        $elemento = new Elemento();
        $elemento->tipo = $request->tipo;
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->no_serie = $request->no_serie;
        $elemento->cantidad = $request->cantidad;
        $elemento->save();

        return $elemento;
    }
 

    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $elemento = Elemento::findOrFail($id);
        $elemento->tipo = $request->tipo;
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->no_serie = $request->no_serie;
        $elemento->cantidad = $request->cantidad;
        $elemento->update();
    }

    public function destroy($id)
    {
        $elemento=Elemento::findOrFail($id);
        $elemento->eliminado=1;
        $elemento->update();
    }
}
