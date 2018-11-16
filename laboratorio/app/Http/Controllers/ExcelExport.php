<?php

namespace Lab\Http\Controllers;

use Lab\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Lab\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lab\Http\Controllers\Session;
use Lab\Elemento;
use DB;
use File;
class ExcelExport extends Controller
{
    public function index(){
        return view('subir');
    }

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

    public function import(Request $request){
        // Validar archivo
        $this->validate($request, array(
            'file'      => 'required'
        ));
     
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
     
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
     
                    foreach ($data as $key => $value) {
                        $insert[] = [
                            'tipo' => $value->tipo,
                            'nombre' => $value->nombre,
                            'descripcion' => $value->descripcion,
                            'clase' => $value->clase,
                            'estado_fisico' => $value->estado_fisico,
                            'formula_quimica' => $value->formula_quimica,
                            'no_serie' => $value->no_serie,
                            'no_piezas' => $value->no_piezas,
                            'cantidad' => $value->cantidad,
                            'unidad_medida' => $value->unidad_medida,
                        ];
                    }
     
                    if(!empty($insert)){
     
                        $datoInsertado = DB::table('elementos')->insert($insert);
                        if ($datoInsertado) {

                        }else {                        
                            return back();
                        }
                    }
                }
     
                return back();
     
            }else {

                return back();
            }
        }
    }
}
