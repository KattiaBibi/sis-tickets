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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('empresa','EmpresaController');
Route::post('datatable/empresas', 'EmpresaController@empresa')->name('datatable.empresa');



Route::resource('estado','EstadoController');
Route::get('datatable/estados', 'EstadoController@estado')->name('datatable.estado');

/* Route::get('/empresa/store', 'EmpresaController@store')->name('/empresa/store'); */

//  Route::get('/calendario','CalendarioController@index')->name('calendario');
