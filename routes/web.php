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


Route::resource('departamento','DepartamentoController');

Route::resource('facultad','FacultadController');

Route::resource('materia','MateriaController');

Route::resource('carrera','CarreraController');

Route::resource('usuario','UsuarioController');

Route::resource('grupo','GrupoController');

Route::resource('gestion','GestionController');

Route::resource('asignacion','AsignacionController');

Route::post('asignacion/store', 'AsignacionController@store');

//Route::get('asignacion/store', 'AsignacionController@store');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
