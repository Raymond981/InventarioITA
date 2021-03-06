<?php

namespace Lab\Http\Controllers;

use Illuminate\Http\Request;
use Lab\Elemento;
use Lab\Http\Resources\MaterialResource as Material;

class MaterialController extends Controller
{
    public function index()
    {
        $elemento = Elemento::orderBy('nombre', 'asc')->where('tipo','material')->where('eliminado','=',0)->get();
        return Material::collection($elemento);
    }


    public function store(Request $request)
    {
        $elemento = new Elemento();
        $elemento->tipo = "material";
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->no_serie = $request->no_serie;
        $elemento->no_piezas = $request->no_piezas;
        $elemento->save();

        return new Material($elemento);
    }
 

    public function show($id)
    {
        $elemento = Elemento::findOrFail($id);
        return new Material($elemento);   
    }


    public function update(Request $request, $id)
    {
        $elemento = Elemento::findOrFail($id);
        $elemento->nombre = $request->nombre;
        $elemento->descripcion = $request->descripcion;
        $elemento->no_serie = $request->no_serie;
        $elemento->no_piezas = $request->no_piezas;

        $elemento->update();
    }

    public function destroy($id)
    {
        $elemento=Elemento::findOrFail($id);
        $elemento->eliminado=1;
        $elemento->update();
    }
}
