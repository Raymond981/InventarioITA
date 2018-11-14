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

Route::apiResource('reactivos', 'ReactivoController');
// Route::apiResource('Elements/materiales', 'MaterialController')->middleware('cors');
// Route::apiResource('Elements/equipos', 'EquipoController')->middleware('cors');

// Route::group(['middleware' => 'cors'], function ($router) {

//     Route::get('reactivos', 'ReactivoController@index');
//     Route::post('reactivos2', 'ReactivoController@store');

// });