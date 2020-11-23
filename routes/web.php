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



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register'=>false,'reset'=>false]);

Route::group(['middleware'=>['permission:acceso-al-sistema']],function(){
    
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
    


    Route::resource('rango','RangoController');
    Route::resource('docente','DocenteController');

    Route::get('/principal', 'PrincipalController@index')->name('principal');

    Route::get('/importar','UserController@importar');
    Route::post('/importar','UserController@guardar')->name('guardar');

    Route::get('/configuracion','ControlConfiguracionController@index');
    Route::get('/permisos','ControlConfiguracionController@crearPermisos');
    Route::get('/horasydias','ControlConfiguracionController@crearHorasyDias');


    Route::resource('asistencia','AsistenciaController');//asistencia
    Route::post('asistencia/store', 'AsistenciaController@store');
    Route::get('asistenciamenu','AsistenciaController@menu');
    Route::get('asistencialista','AsistenciaController@list')->name('asistencialista');

    Route::resource('ausencia','AusenciaController');
    Route::post('ausencia/store', 'AusenciaController@store');
    Route::resource('reposicion','ReposicionController');
    Route::get('ausencialista','AusenciaController@list')->name('ausencialista');
    Route::get('/ausencialista/{id}/edit', 'AusenciaController@editarlista');
    Route::post('/ausencialista/update/{id}', 'AusenciaController@actualizarlista');

    Route::resource('asistenciacontrol','AsistenciaControlController');//asistencia
    Route::post('asistenciacontrol/store', 'AsistenciaControlController@store');

    Route::resource('reposicion','ReposicionController');
    Route::get('/reposicion/{id}/index', 'ReposicionController@ver')-> name('ver');
    Route::get('/reposicion/create/{id}', 'ReposicionController@crear');
    Route::post('/reposicion/store/{id}', 'ReposicionController@almacenar');
    Route::get('/reposicion/edit/{id}', 'ReposicionController@editar');
    Route::post('/reposicion/update/{id}', 'ReposicionController@actualizar');
    Route::post('/reposicion/delete/{id}', 'ReposicionController@eliminar');

    Route::get('reposicionlista','ReposicionController@list')->name('reposicionlista');
    Route::get('/reposicionlista/{id}/edit', 'ReposicionController@editarlista');
    Route::post('/reposicionlista/update/{id}', 'ReposicionController@actualizarlista');


    Route::resource('mensual','MensualController');//asistencia
    Route::post('mensual/store', 'MensualController@store');
    Route::get('/mensual/{id}/edit', 'MensualController@editar');
    Route::post('/mensual/update/{id}', 'MensualController@actualizar');

    Route::get('asignacion/getgroups/{id}','AsignacionController@getgroups');
    Route::get('asignacion/gethorarios/{id}','AsignacionController@gethorarios');

});