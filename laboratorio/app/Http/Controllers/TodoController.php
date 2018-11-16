<?php

namespace Lab\Http\Controllers;

use Illuminate\Http\Request;
use Lab\Elemento;
use Lab\Http\Resources\ElementoResource as Todo;
class TodoController extends Controller
{
    
    public function index()
    {
        $elemento = Elemento::orderBy('nombre', 'asc')->where('eliminado','=',0)->get();
        return Todo::collection($elemento);
    }


    public function store(Request $request)
    {
        $elemento = new Elemento();
        $elemento->tipo = "reactivo";
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->clase = $request->clase;
        $elemento->estado_fisico = $request->estado_fisico;
        $elemento->formula_quimica = $request->formula_quimica;
        $elemento->no_serie = $request->no_serie;
        $elemento->no_piezas = $request->no_piezas;
        $elemento->cantidad = $request->cantidad;
        $elemento->unidad_medida = $request->unidad_medida;
        $elemento->save();
        
        return new Todo($elemento);
    }
    
    public function show($id)
    {
     $elemento = Elemento::findOrFail($id);
     return new Todo($elemento);   
    }


    public function update(Request $request, $id)
    {
        $elemento = Elemento::findOrFail($id);
        $elemento->tipo = "reactivo";
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->clase = $request->clase;
        $elemento->estado_fisico = $request->estado_fisico;
        $elemento->formula_quimica = $request->formula_quimica;
        $elemento->no_serie = $request->no_serie;
        $elemento->no_piezas = $request->no_piezas;
        $elemento->cantidad = $request->cantidad;
        $elemento->unidad_medida = $request->unidad_medida;
        $elemento->update();
    }

    public function destroy($id)
    {
        $elemento=Elemento::findOrFail($id);
        $elemento->eliminado=1;
        $elemento->update();
    }
}
