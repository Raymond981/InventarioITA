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
}
