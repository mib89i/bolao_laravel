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
Route::get('/visualiza_rodada/{rodada_finalizada}', 'HomeController@visualizaRodada');

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
Route::patch('/temporadas/{temporada}/excluir', 'TemporadasController@excluir');
Route::patch('/temporadas/{temporada}/terminar', 'TemporadasController@terminar');

Route::get('/temporadas/{temporada}', 'TemporadasController@mostrar');
Route::get('/temporadas/{temporada}/{nome}/divisao/{divisao}', 'TemporadasController@temporadaDivisao');
Route::get('/temporadas/ajax/get_lista_usuario', 'TemporadasController@getListaUsuario');
Route::post('/temporadas/{temporada}/adicionar_divisao', 'TemporadasController@adicionarDivisao');

Route::get('/temporadas/{temporada}/status_convite/{mensagem}/{status}', 'TemporadasController@statusConvite');
Route::get('/temporadas/{temporada}/sair/temporada', 'TemporadasController@sairTemporada');
Route::get('/temporadas/add_para_divisao/{temporada_divisao}/usuario/{usuario}', 'TemporadasController@adicionarUsuarioParaDivisao');

// CONVITES
Route::get('/convites/t/{temporada}/tipo/{tipo_convite}/{usuario}', 'TemporadasController@enviarConviteTemporada');
Route::get('/convites/t/{temporada}/tipo/{tipo_convite}', 'TemporadasController@entrarTemporada');

// MENSAGENS
Route::get('/mensagens', 'MensagensController@index');

// RODADAS
Route::get('/rodada', 'RodadaController@index');
Route::get('/rodada/{rodada}/ver', 'RodadaController@mostrar');

Route::get('/rodada/criar', 'RodadaController@criarRodada');
Route::post('/rodada/criar', 'RodadaController@gravarRodada');

Route::get('/rodada/{rodada}/editar', 'RodadaController@editarRodada');
Route::patch('/rodada/{rodada}/editar', 'RodadaController@atualizarRodada');
Route::post('/rodada/{rodada}/editar/adicionar_jogo', 'RodadaController@adicionarJogoRodada');
Route::get('/rodada/{rodada}/limpar_sessao', 'RodadaController@limparSessao');

Route::patch('/rodada/{rodada}/editar/jogos', 'RodadaController@atualizarJogoRodada');
Route::delete('/rodada/{rodada}/excluir/jogo/{jogo}', 'RodadaController@excluirJogoRodada');
Route::delete('/rodada/{rodada}/excluir', 'RodadaController@excluir');
Route::post('/rodada/{rodada}/palpite', 'RodadaController@gravarPalpite');
Route::get('/rodada/{rodada}/terminar', 'RodadaController@terminarRodada');
Route::get('/rodada/{rodada}/ranking', 'RodadaController@rankingRodada');
Route::get('/rodada/{rodada}/palpites/{usuario}', 'RodadaController@palpiteUsuarioRodada');

// TIMES
Route::get('/times/ajax/get_lista_time', 'TimesController@getListaTime');
Route::get('/times/ajax/get_lista_time2', 'TimesController@getListaTime2');
Route::get('/times/{time}/selecionar/{tipo_time}', 'TimesController@selecionarTime');
Route::get('/times/{time}/tirar', 'TimesController@tirarTime');

Route::get('/perfil/', 'PerfilController@index');
Route::get('/perfil/{usuario}/{nome}', 'PerfilController@perfilUsuario');



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

