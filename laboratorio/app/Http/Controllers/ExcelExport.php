<?php

namespace Lab\Http\Controllers;

use Lab\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Lab\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Lab\Material;
class ExcelExport extends Controller
{
    function excel(){

        $products = Material::select('nombre_material','descripcion_material','stock_material','capacidad_material','observaciones_material')->get()->toArray();
        return \Excel::create('Inventario Materiales'." - ".date('d-m-Y'), function($excel) use ($products) {
            $excel->sheet('Materials Details', function($sheet) use ($products)
            {
                $sheet->fromArray($products);
            });
        })->download('xlsx');
    }
}
