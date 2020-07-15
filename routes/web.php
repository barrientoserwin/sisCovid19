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
/*
Route::get('/', function () {
    return view('contenido/contenido');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');*/
Route::get('/', 'PaginaController@index');

Route::group(['middleware'=>['guest']],function(){
    Route::get('/sistema','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login')->name('login');
});
Auth::routes();
Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Medico']], function () {
        //Rutas Paciente, EnfermedadBase
        Route::get('/paciente','PacienteController@index');
        Route::post('/paciente/registrar','PacienteController@store');
        Route::put('/paciente/modificar','PacienteController@update');
        Route::put('/paciente/eliminar','PacienteController@delete');
        //Route::put('/paciente/eliminarEnfermedad','PacienteController@deleteEnfermedad');
        //Route::get('/paciente/selectEnfermedad','PacienteController@selectEnfermedad');

        //Rutas Hospital
        Route::get('/hospital','HospitalController@index');
        Route::post('/hospital/registrar','HospitalController@store');
        Route::put('/hospital/modificar','HospitalController@update');
        Route::put('/hospital/eliminar','HospitalController@delete');
    });
    



    Route::group(['middleware' => ['Administrador']], function () {
        //Rutas Zona
        Route::get('/zona','ZonaController@index');
        Route::get('/zona/selectProvincia','ZonaController@selectProvincia');
        Route::get('/zona/selectMunicipio','ZonaController@selectMunicipio');
        Route::get('/zona/selectZona','ZonaController@selectZona');

        //Rutas Paciente, EnfermedadBase
        Route::get('/paciente','PacienteController@index');
        Route::post('/paciente/guardar','PacienteController@store');
        Route::put('/paciente/modificar','PacienteController@update');
        Route::delete('/paciente/eliminar/{id}','PacienteController@delete');

        //Rutas Hospital
        Route::get('/hospital','HospitalController@index');        
        Route::post('/hospital/guardar','HospitalController@store');
        Route::put('/hospital/modificar','HospitalController@update');
        Route::delete('/hospital/eliminar/{id}','HospitalController@delete');
        Route::get('/hospital/getDatos/{id}','HospitalController@getDatos');

        //Rutas para Rol
        Route::get('/rol','RolController@index');
        Route::get('/rol/selectRol','RolController@selectRol');

        //Rutas Usuarios Medicos
        Route::get('/usuario','UsuarioController@index');
        Route::post('/usuario/guardar','UsuarioController@store');
        Route::put('/usuario/modificar','UsuarioController@update');
        Route::put('/usuario/desactivar','UsuarioController@desactivar');
        Route::put('/usuario/activar','UsuarioController@activar');

        //Rutas Sintoma
        Route::get('/sintoma','SintomaController@index');
        Route::post('/sintoma/guardar','SintomaController@store');
        Route::put('/sintoma/modificar','SintomaController@update');
        Route::delete('/sintoma/eliminar/{id}','SintomaController@delete');
        Route::get('/sintoma/getDatos/{id}','SintomaController@getDatos');
        Route::get('/sintoma/selectSintoma','SintomaController@selectSintoma');
        Route::get('/sintoma/selectSintomaId','SintomaController@selectSintomaId');

        //Rutas Medicamento
        Route::get('/medicamento','MedicamentoController@index');
        Route::post('/medicamento/guardar','MedicamentoController@store');
        Route::put('/medicamento/modificar','MedicamentoController@update');        
        Route::delete('/medicamento/eliminar/{id}','MedicamentoController@delete');
        Route::get('/medicamento/getDatos/{id}','MedicamentoController@getDatos');
        Route::get('/medicamento/selectMedicamento','MedicamentoController@selectMedicamento');

        // Rutas para Orden
        Route::get('/orden','OrdenController@index');
        Route::post('/orden/guardar','OrdenController@store');
        Route::put('/orden/modificar','OrdenController@update');        
        Route::delete('/orden/eliminar/{id}','OrdenController@delete');
        Route::get('/orden/getDatos/{id}','OrdenController@getDatos');

        //Rutas para OrdenRevision
        Route::get('/ordenRevision','OrdenRevisionController@index');
        Route::post('/ordenRevision/guardar','OrdenRevisionController@store');
        Route::put('/ordenRevision/modificar','OrdenRevisionController@update');

        //Rutas para Resultados
        Route::get('/resultado','ResultadoController@index');
        Route::post('/resultado/guardar','ResultadoController@store');
        Route::put('/resultado/modificar','ResultadoController@update');
        
    });    
});

