<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('storage-link', function(){

    if(file_exists(public_path('storage'))){

        return 'The "public-storage" directory already exists.';
    }

    app('files')->link(
        storage_path('app/public'), public_path('storage')
    );

    return 'The [public/storage] directory has been linked.';
});


Route::get('/dashboard', 'HomeController@index')->middleware('can:admin.home')->name('dashboard');
Route::get('/dashboard/getLastRequerimientos', 'HomeController@getLastRequerimientos');


Route::get('requerimiento/sendWspMessage', 'RequerimientoController@sendWspMessage');
Route::resource('requerimiento','RequerimientoController');
Route::resource('historialfechahora','HistorialFechaHoraController');
Route::get('datatable/requerimientos', 'RequerimientoController@requerimiento')->name('datatable.requerimiento');
Route::get('requerimiento/{id}/listado', 'RequerimientoController@listarservicios')->name('requerimiento.listado');
Route::get('requerimiento/{id}/getdetalle', 'RequerimientoController@getdetalle')->name('requerimiento.detalle');
Route::get('download/{archivo}', 'RequerimientoController@getDownload');


Route::get('gerente/{id}/listado', 'RequerimientoController@listargerentes')->name('gerente.listado');
Route::get('personal/{id}/listado', 'RequerimientoController@listarcolaboradores')->name('colaborador.listado');

Route::resource('usuario','UserController');
Route::post('datatable/usuarios', 'UserController@usuario')->name('datatable.usuario');
Route::get('usuario/perfil', 'UserController@show')->name('usuario.perfil');

Route::resource('colaborador','ColaboradorController');
Route::post('datatable/colaboradores', 'ColaboradorController@colaborador')->name('datatable.colaborador');
Route::get('colaboradores/search', 'ColaboradorController@search');

Route::get('empresa/search', 'EmpresaController@search');
Route::resource('empresa','EmpresaController');
Route::post('datatable/empresas', 'EmpresaController@empresa')->name('datatable.empresa');
Route::get('api/empresa/getOrganigrama', 'EmpresaController@getOrganigrama');

Route::resource('area','AreaController');
Route::post('datatable/areas', 'AreaController@area')->name('datatable.area');

Route::resource('rol','RolController');
Route::get('/rol/permiso/{id}','RolController@permiso');
Route::post('datatable/roles', 'RolController@rol')->name('datatable.rol');

Route::resource('permiso','PermisoController');
Route::post('datatable/permisos', 'PermisoController@permiso')->name('datatable.permiso');

Route::resource('servicio','ServicioController');
Route::post('datatable/servicios', 'ServicioController@servicio')->name('datatable.servicio');


Route::get('empresa_area/search', 'EmpresaAreaController@search');
Route::resource('empresa_area','EmpresaAreaController');
Route::post('datatable/empresa_areas', 'EmpresaAreaController@empresa_area')->name('datatable.empresa_area');

Route::resource('empresa_servicio','EmpresaServicioController');
Route::post('datatable/empresa_servicios', 'EmpresaServicioController@empresa_servicio')->name('datatable.empresa_servicio');

Route::get('cita/reenviarEmail', 'CitaController@reenviarEmail');
Route::get('cita/confirmar-asistencia', 'CitaController@confirmarAsistencia');
Route::get('cita/getForFullCalendar', 'CitaController@getForFullCalendar');
Route::resource('cita','CitaController');
Route::get('cita/{id}', 'CitaController@show');
