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


Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'HomeController@index')->name('login');

// LOGIN COM FACEBOOK
Route::get('/login/facebook', 'LoginController@redirectToProvider');
Route::get('/login/facebook/callback', 'LoginController@handleProviderCallback');
Route::get('/logout', 'LoginController@logout')->name('logout');
// END LOGIN COM FACEBOOK

// TEMPORADAS
Route::get('/temporadas', 'TemporadasController@index');
Route::post('/temporadas', 'TemporadasController@index');

Route::get('/temporadas/criar', 'TemporadasController@criar');
Route::post('/temporadas/criar', 'TemporadasController@gravar');

Route::get('/temporadas/{temporada}/editar', 'TemporadasController@editar');
Route::patch('/temporadas/{temporada}/editar', 'TemporadasController@atualizar');
Route::delete('/temporadas/{temporada}/excluir', 'TemporadasController@excluir');

Route::get('/temporadas/{temporada}', 'TemporadasController@mostrar');
Route::get('/temporadas/{temporada}/request', 'TemporadasController@request');

Route::get('/temporadas/{temporada_usuario}/request_accepted', 'TemporadasController@request_accepted');
Route::get('/temporadas/{temporada_usuario}/request_denied', 'TemporadasController@request_denied');
Route::get('/temporadas/{temporada_usuario}/denied', 'TemporadasController@denied');

// s para criar uma temporada
Route::get('/games/s/{season}/create', 'GamesController@create_sgame');
Route::post('/games/s/{season}/create', 'GamesController@store_sgame');

// c para criar uma copa
Route::get('/games/c/{cup}/create', 'GamesController@create_cgame');

// AJAX
Route::get('/games/ajax/get_list_times', 'GamesController@get_list_times');
Route::get('/games/ajax/get_select_times', 'GamesController@get_select_times');
// via post funciona, olhar comentário em games/create.blade.php
//Route::post('/games/search_time', 'GamesController@search_time');

// 
// --- SEASONS


// NOTIFICATIONS
Route::get('/notifications', 'NotificationsController@index');