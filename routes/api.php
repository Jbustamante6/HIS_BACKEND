<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'cors'],function(){
    Route::post('auth', 'AuthController@auth');
    Route::group(['middleware'=> 'jwt.auth'], function () {
      Route::resource('users', 'UsersController');  
      Route::resource('pacientes', 'PacientesController');
      Route::resource('ordenes', 'OrdenController');
      Route::resource('modalidades', 'ModalidadController');
      Route::resource('lecturas', 'LecturasController');
      Route::resource('imagenes', 'ImagenController');
      Route::resource('estudios', 'EstudiosController');
      Route::resource('estadosEstudios', 'EstadoEstudioController');
      Route::resource('eps', 'EPSController');
      Route::resource('birards', 'BirardsController');
      Route::resource('birardsEstudios', 'BirardsEstudiosController');
      Route::resource('autorizacion', 'AutorizacionController');
    });
});