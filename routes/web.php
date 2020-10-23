<?php

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




Route::resource('departamento','DepartamentoController');

Route::resource('facultad','FacultadController');

Route::resource('materia','MateriaController');

Route::resource('carrera','CarreraController');

Route::resource('grupo','GrupoController');

Route::resource('gestion','GestionController');

Route::resource('asignacion','AsignacionController');

Route::post('asignacion/store', 'AsignacionController@store');

//Route::get('asignacion/store', 'AsignacionController@store');

Route::resource('user','UserController');

Route::get('/grupo/{id}/index', 'GrupoController@vergrupos')-> name('vergrupos');
Route::get('/grupo/create/{id}', 'GrupoController@creargrupo');
Route::post('/grupo/store/{id}', 'GrupoController@almacenar');
Route::get('/grupo/{id}/edit', 'GrupoController@editargrupo');
Route::post('/grupo/update/{id}', 'GrupoController@actualizargrupo');
Route::post('/grupo/delete/{id}', 'GrupoController@eliminargrupo');

//Route::resource('horario','HorarioController');

Route::get('/horario/{id}/index', 'HorarioController@verhorarios')-> name('verhorarios');
Route::get('/horario/create/{id}', 'HorarioController@crearhorario');
Route::post('/horario/store/{id}', 'HorarioController@almacenar');
Route::get('/horario/{id}/edit', 'HorarioController@editarhorario');
Route::post('/horario/update/{id}', 'HorarioController@actualizarhorario');
Route::post('/horario/delete/{id}', 'HorarioController@eliminarhorario');
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('role','RoleController');
Route::resource('docente','DocenteController');

Route::get('/administrador', function () {
    return view('auth.administrador');
});