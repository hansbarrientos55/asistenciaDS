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

Route::get('/home', function () {
    return view('welcome');
});

Route::get('login', function () {
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

    Route::resource('user','UserController');

    Route::post('/user/disable/{id}', 'UserController@disable');
    Route::post('/departamento/disable/{id}', 'DepartamentoController@disable');
    Route::post('/carrera/disable/{id}', 'CarreraController@disable');
    Route::post('/facultad/disable/{id}', 'FacultadController@disable');
    Route::post('/gestion/disable/{id}', 'GestionController@disable');
    Route::post('/materia/disable/{id}', 'MateriaController@disable');

    Route::post('/user/enable/{id}', 'UserController@enable');
    Route::post('/departamento/enable/{id}', 'DepartamentoController@enable');
    Route::post('/carrera/enable/{id}', 'CarreraController@enable');
    Route::post('/facultad/enable/{id}', 'FacultadController@enable');
    Route::post('/gestion/enable/{id}', 'GestionController@enable');
    Route::post('/materia/enable/{id}', 'MateriaController@enable');

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

    Route::get('descargarejemplo','UserController@descargarejemplo');

    Route::get('/configuracion','ControlConfiguracionController@index');
    Route::get('/permisos','ControlConfiguracionController@crearPermisos');
    Route::get('/horasydias','ControlConfiguracionController@crearHorasyDias');

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

    Route::resource('bitacora','BitacoraController');

    Route::get('migracion', 'MigracionController@index' );
    Route::get('migracionpostgre', 'MigracionController@generarPostgre' );
    Route::get('migracionmy', 'MigracionController@generarMy' );
    Route::get('respaldar','MigracionController@respaldaraplicacion');
    Route::get('respaldos','MigracionController@respaldos');
    Route::get('respaldo/descarga/{id}','MigracionController@respaldodescarga');
    //Route::get('migracion', 'MigracionController@inicio' );

    Route::get('event/add','EventController@createEvent');
    Route::post('event/add','EventController@store');
    Route::get('event','EventController@calendar'); 
    Route::get('event/list','EventController@list');
    Route::get('event/edit/{id}','EventController@edit');
    Route::post('event/edit/{id}','EventController@update');
    Route::post('event/delete/{id}','EventController@destroy');

    //Route::resource('asignacion','AsignacionController');
    Route::get('asignacion','AsignacionController@asignaciones');

    Route::get('asignacion/crear','AsignacionController@crear');
    Route::get('asignacion/grupo','AsignacionController@grupo');
    Route::post('asignacion/grupo','AsignacionController@grupo');
    Route::post('asignacion/guardar', 'AsignacionController@guardar');

    Route::get('asignacion/editar/{id}','AsignacionController@editar');
    Route::get('asignacion/editar/grupo/{id}','AsignacionController@editargrupo');
    Route::post('asignacion/editar/grupo/{id}','AsignacionController@editargrupo');
    Route::post('asignacion/editar/guardar/{id}', 'AsignacionController@actualizar');

    Route::post('asignacion/eliminar/{id}','AsignacionController@eliminar');

    Route::resource('asistencia','AsistenciaController');//asistencia

    Route::get('asistenciamateria','AsistenciaController@materia');
    Route::get('asistenciagrupo','AsistenciaController@grupo');
    Route::post('asistenciagrupo','AsistenciaController@grupo');
    Route::get('asistenciahorario','AsistenciaController@horario');
    Route::post('asistenciahorario','AsistenciaController@horario');
    Route::get('asistenciadatos','AsistenciaController@datos');
    Route::post('asistenciadatos','AsistenciaController@datos');
    Route::post('asistenciaguardar', 'AsistenciaController@guardar');

    Route::get('asistenciamateriaeditar/{id}','AsistenciaController@materiaeditar');
    Route::get('asistenciagrupoeditar/{id}','AsistenciaController@grupoeditar');
    Route::post('asistenciagrupoeditar/{id}','AsistenciaController@grupoeditar');
    Route::get('asistenciahorarioeditar/{id}','AsistenciaController@horarioeditar');
    Route::post('asistenciahorarioeditar/{id}','AsistenciaController@horarioeditar');
    Route::get('asistenciadatoseditar/{id}','AsistenciaController@datoseditar');
    Route::post('asistenciadatoseditar/{id}','AsistenciaController@datoseditar');
    Route::post('asistencia/actualizar/{id}', 'AsistenciaController@actualizar');

    Route::post('asistencia/store', 'AsistenciaController@store');
    Route::get('asistenciamenu','AsistenciaController@menu');
    Route::get('asistencialista','AsistenciaController@list')->name('asistencialista');

    Route::get('prepararmensual','MensualController@preparar');
    Route::get('preparar','ReporteController@preparar');
    Route::get('preparardepa/{id}','ReporteController@preparardepartamento');
    
});