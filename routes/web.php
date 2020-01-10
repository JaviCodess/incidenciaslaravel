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

Auth::routes();

Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');



Route::middleware(['profe'])->group(function () {
Route::get('/home', 'HomeController@index')->name('home');
//Iniciar sesión con google

//Crear una incidencia
Route::get('/home/crear-incidencia','ControladorIncidencia@cIncidencia');
Route::post('/home/crear-incidencia/rellenar','ControladorIncidencia@validator');

//Modificar incidencias
Route::get('/home/modificar-incidencia/{i}','ControladorIncidencia@modvistaIncidencia');
Route::post('/home/modificar-incidencia/{i}/modificado','ControladorIncidencia@modIncidencia');
Route::get('/home/eliminar-incidencia/{i}','ControladorIncidencia@eliminarIncidencia');

//Consultar incidencia
Route::get('/home/consultar-incidencia/{i}','ControladorIncidencia@consultar');
});
Route::middleware(['admin'])->group(function () {
//ADMIN
Route::get('/home-admin','HomeController@indexAdmin')->name('home-admin');
//Añadir informacion
Route::get('/home-admin/anadir/{i}','ControladorIncidencia@anadir');
Route::post('/home-admin/anadir/{i}/modificado','ControladorIncidencia@actualizarAnadir');
});