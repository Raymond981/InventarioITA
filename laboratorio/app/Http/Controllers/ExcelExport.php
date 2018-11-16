<?php

namespace Lab\Http\Controllers;

use Lab\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Lab\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Lab\Elemento;
class ExcelExport extends Controller
{
    function excel($tipo){

    	if($tipo == "todo"){
    		$products = Elemento::select('id','tipo','nombre','descripcion','clase','estado_fisico','formula_quimica','no_serie','cantidad','unidad_medida')->where('eliminado','=',0)->get()->toArray();
    	}else if($tipo == "reactivo" || $tipo == "equipo" || $tipo == "material"){
    		$products = Elemento::select('id','tipo','nombre','descripcion','clase','estado_fisico','formula_quimica','no_serie','cantidad','unidad_medida')->where('eliminado','=',0)->where('tipo',$tipo)->get()->toArray();
    	}
        return \Excel::create('Inventario Materiales'." - ".date('d-m-Y'), function($excel) use ($products) {
            $excel->sheet('Materials Details', function($sheet) use ($products)
            {
                $sheet->fromArray($products);
            });
        })->download('xlsx');
    }
}
