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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/departamento', 'DepartamentoController@index');

//Route::get('/departamento/crear','DepartamentoController@create');

Route::resource('departamento','DepartamentoController');

Route::resource('facultad','FacultadController');

Route::resource('materia','MateriaController');

Route::resource('carrera','CarreraController');

Route::resource('usuario','UsuarioController');

Route::resource('grupo','GrupoController');

Route::resource('gestion','GestionController');

//Route::resource('asignacion','AsignacionController');

Route::get('asignacion', 'AsignacionController@asignacion')->name('asignacion');

Route::post('pedido', 'AsignacionController@pedido')->name('pedido');

Route::get('pedido', 'AsignacionController@pedido')->name('pedido');

Route::get('listado', 'AsignacionController@listado')->name('listado');

Route::post('listado', 'AsignacionController@listado')->name('listado');