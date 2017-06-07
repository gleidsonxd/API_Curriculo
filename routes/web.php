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
Route::group(['middleware' => 'authbasichttp'], function () {

    #Routes Usuarios
    Route::get('usuarios','UsuarioController@list');
    Route::get('usuarios/{id}','UsuarioController@read');
    Route::post('usuarios','UsuarioController@create');
    Route::put('usuarios/{id}','UsuarioController@update');
    Route::put('usuariospass/{id}','UsuarioController@updatepass');
    Route::delete('usuarios/{id}','UsuarioController@delete');
    Route::post('usuarioslogin','UsuarioController@login');
    #Routes Gestor
    Route::get('gestors','GestorController@list');
    Route::get('gestors/{id}','GestorController@read');
    Route::post('gestors','GestorController@create');
    Route::put('gestors/{id}','GestorController@update');
    Route::put('gestorspass/{id}','UsuarioController@updatepass');
    Route::delete('gestors/{id}','GestorController@delete');
    Route::post('gestorslogin','GestorController@login');
    #Routes Curriculo
    Route::get('curriculos','CurriculoController@list');
    Route::get('curriculos/{id}','CurriculoController@read');
    Route::post('curriculos','CurriculoController@create');
    Route::post('curriculos/{id}','CurriculoController@update');
    Route::delete('curriculos/{id}','CurriculoController@delete');
    #Routes Oportunidades
    Route::get('oportunidades','OportunidadeController@list');
    Route::get('oportunidades/{id}','OportunidadeController@read');
    Route::post('oportunidades','OportunidadeController@create');
    Route::put('oportunidades/{id}','OportunidadeController@update');
    Route::delete('oportunidades/{id}','OportunidadeController@delete');
    Route::get('oportunidades/join/{id}','OportunidadeController@join');
    Route::get('oportunidades/leave/{id}','OportunidadeController@leave');
});