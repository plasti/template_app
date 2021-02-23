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

Route::get('/', function () {return view('welcome');});
Auth::routes();
Route::group(['middleware' => 'auth'], function () {

	// home
	Route::get('/app', 'HomeController@index')->name('home');
	Route::get('/home', 'HomeController@index2')->name('home2');

	// perfil
	Route::get('/perfil', 'PerfilController@index')->name('perfil');
	Route::post('/update-avatar', 'PerfilController@avatar')->name('perfil.avatar');
	Route::get('/perfil/edit', 'PerfilController@edit')->name('perfil.edit');
	Route::post('/perfil/save', 'PerfilController@save')->name('perfil.save');

	// ----------------
	// ADMIN DE LA APP
	// ----------------

	// usuarios
	Route::get('/usuarios', 'UsersController@index')->name('usuarios');
	Route::get('/usuarios/{id}/edit', 'UsersController@edit')->name('usuarios.edit');
	Route::post('/usuarios/{id}/update', 'UsersController@update')->name('usuarios.update');
});
