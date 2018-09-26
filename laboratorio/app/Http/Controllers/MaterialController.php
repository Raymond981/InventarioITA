<?php

namespace Lab\Http\Controllers;

use Illuminate\Http\Request;

use Lab\Http\Requests;
use Lab\Material;
use Illuminate\Support\Facades\Redirect;
use Lab\Http\Requests\MaterialFormRequest;
use DB;

class MaterialController extends Controller
{
   	public function __construct(){

   	}

   	public function index(Request $request){
   		if($request){
   			$query=trim($request->get('searchText')); //Buscar por material y id
   			$materiales=DB::table('materiales')->where('nombre_material','LIKE','%'.$query.'%')->where('condicion','=',1)->orderBy('idmateriales','desc')
   			->paginate(10);
   			return view('almacen.materiales.index',["materiales"=>$materiales, "searchText"=>$query]);
   		}
   	}

   	public function create(){
   		return view("almacen.materiales.create");
   	}

   	public function store(MaterialFormRequest $request){ //Almacenarr
   		$materiales = new Material;
   		$materiales->nombre_material=$request->get('nombre_material');
   		$materiales->descripcion_material=$request->get('descripcion_material');
   		$materiales->stock_material=$request->get('stock_material');
         $materiales->capacidad_material=$request->get('capacidad_material');
         $materiales->observaciones_material=$request->get('observaciones_material');
   		$materiales->condicion=1;
   		$materiales->save();
   		return Redirect::to('almacen/materiales');
   	}

   	public function show($id){
   		return view("almacen.materiales.show",["material"=>Material::findOrFail($id)]);
   	}

   	public function edit($id){
   		return view ("almacen.materiales.edit",["material"=>Material::findOrFail($id)]);
   	}

   	public function update(MaterialFormRequest $request, $id){
   		$material = Material::findOrFail($id);
   		$material->nombre_material=$request->get('nombre_material');
   		$material->descripcion_material=$request->get('descripcion_material');
         $material->capacidad_material=$request->get('capacidad_material');
         $materiales->observaciones_material=$request->get('observaciones_material');
   		$material->update();
   		return Redirect::to("almacen/materiales");
   	}

   	public function destroy($id){
   		$material=Material::findOrFail($id);
   		$material->condicion=0;
   		$material->update();
   		return Redirect::to('almacen/materiales');
   	}
}
