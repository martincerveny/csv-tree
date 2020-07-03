<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TreeController@index')->name('tree.index');
Route::get('/tree/{id}', 'TreeController@show')->name('tree.show');
Route::get('/tree/{id}/calculate', 'TreeController@calculate')->name('tree.calculate');
Route::get('/tree/{id}/move', 'TreeController@move')->name('tree.move');
Route::post('/tree/{id}/changeParent', 'TreeController@changeParent')->name('tree.changeParent');
Route::get('/export', 'ExportController@index')->name('export.index');
