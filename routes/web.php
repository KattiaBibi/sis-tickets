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

Route::resource('empresa','EmpresaController');
Route::get('datatable/empresas', 'DatatableController@empresa')->name('datatable.empresa');

Route::get('/home', 'HomeController@index')->name('home');
/* Route::get('/empresa/store', 'EmpresaController@store')->name('/empresa/store'); */

//  Route::get('/calendario','CalendarioController@index')->name('calendario');
