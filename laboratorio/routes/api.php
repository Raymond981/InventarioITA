<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('Elements/reactivos', 'ReactivoController');
Route::apiResource('Elements/materiales', 'MaterialController');
Route::apiResource('Elements/equipos', 'EquipoController');
Route::apiResource('Elements/todos', 'TodoController');

Route::post('Elements/search', 'SearchController@search');
Route::post('Elements/search/equipo', 'SearchController@searchEquipo');
Route::post('Elements/search/material', 'SearchController@searchMaterial');
Route::post('Elements/search/reactivo', 'SearchController@searchReactivo');

Route::get('Elements/excel/{tipo}', 'ExcelExport@excel')->name('export.excel');
Route::post('/subir/import', 'ExcelExport@import')->name('import');
Route::get('/subir', 'ExcelExport@index')->name('index');
// Route::apiResource('Elements/materiales', 'MaterialController')->middleware('cors');
// Route::apiResource('Elements/equipos', 'EquipoController')->middleware('cors');

// Route::group(['middleware' => 'cors'], function ($router) {

//     Route::get('reactivos', 'ReactivoController@index');
//     Route::post('reactivos2', 'ReactivoController@store');

// });
