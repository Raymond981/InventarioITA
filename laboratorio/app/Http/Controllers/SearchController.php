<?php

namespace Lab\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SearchController extends Controller
{
	public function search(Request $request){
		$elemento = DB::table('elementos')->where('nombre','LIKE','%'.$request->search."%")->get();
		return $elemento;
	}
	public function searchEquipo(Request $request){
		$elemento = DB::table('elementos')->where('tipo','equipo')->where('nombre','LIKE','%'.$request->search."%")->get();
		return $elemento;
	}
	public function searchMaterial(Request $request){
		$elemento = DB::table('elementos')->where('tipo','material')->where('nombre','LIKE','%'.$request->search."%")->get();
		return $elemento;
	}
	public function searchReactivo(Request $request){
		$elemento = DB::table('elementos')->where('tipo','reactivo')->where('nombre','LIKE','%'.$request->search."%")->get();
		return $elemento;
	}
}
