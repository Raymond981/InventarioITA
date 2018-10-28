<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/
// use Lab\Exports\UsersExport;

// Route::get('/export/excel', 'ExcelExport@excel')->name('export.excel');
// Route::resource('almacen/materiales', 'MaterialController');
// //Route::view('/', '/layouts/master');
Route::get('{any}', function () {
  return view('welcome');
})->where('any', '.*');