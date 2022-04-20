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
Route::get('/dashboard', 'HomeController@index')->name('dashboard');


Route::resource('requerimiento','RequerimientoController');
Route::post('datatable/requerimientos', 'RequerimientoController@requerimiento')->name('datatable.requerimiento');
Route::post('datatable/requerimientosasignados', 'RequerimientoController@ticketasignado')->name('datatable.ticketasignado');
Route::get('requerimientos_asignados', 'RequerimientoController@asignado')->name('ticket.asignado');


Route::resource('usuario','UserController');
Route::post('datatable/usuarios', 'UserController@usuario')->name('datatable.usuario');
Route::get('requerimiento/{id}/listado', 'RequerimientoController@listarservicios')->name('ticket.listado');

Route::resource('colaborador','ColaboradorController');
Route::post('datatable/colaboradores', 'ColaboradorController@colaborador')->name('datatable.colaborador');


Route::resource('estado','EstadoController');
Route::post('datatable/estados', 'EstadoController@estado')->name('datatable.estado');

Route::resource('empresa','EmpresaController');
Route::post('datatable/empresas', 'EmpresaController@empresa')->name('datatable.empresa');

Route::resource('area','AreaController');
Route::post('datatable/areas', 'AreaController@area')->name('datatable.area');

Route::resource('rol','RolController');
Route::get('/rol/permiso/{id}','RolController@permiso');
Route::post('datatable/roles', 'RolController@rol')->name('datatable.rol');

Route::resource('permiso','PermisoController');
Route::post('datatable/permisos', 'PermisoController@permiso')->name('datatable.permiso');

Route::resource('servicio','ServicioController');
Route::post('datatable/servicios', 'ServicioController@servicio')->name('datatable.servicio');

Route::resource('tipo','TipoCitaController');
Route::post('datatable/tipos', 'TipoCitaController@tipo')->name('datatable.tipo');

Route::resource('prioridad','PrioridadController');
Route::post('datatable/prioridades', 'PrioridadController@prioridad')->name('datatable.prioridad');

Route::resource('empresa_area','EmpresaAreaController');
Route::post('datatable/empresa_areas', 'EmpresaAreaController@empresa_area')->name('datatable.empresa_area');

Route::resource('empresa_servicio','EmpresaServicioController');
Route::post('datatable/empresa_servicios', 'EmpresaServicioController@empresa_servicio')->name('datatable.empresa_servicio');

Route::resource('atencion','AtencionController');
// Route::post('datatable/atenciones', 'Atenciones@atencion')->name('datatable.atencion');

Route::resource('cita','CitaController');
