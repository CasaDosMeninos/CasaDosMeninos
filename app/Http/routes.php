<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('auth/login',	['as' => 'auth.login',		'uses' => 'AuthController@login']);	
Route::get('auth/logout',	['as' => 'auth.logout',		'uses' => 'AuthController@logout']);	
Route::post('auth/login',	['as' => 'auth.postLogin',	'uses' => 'AuthController@postLogin']);	

Route::group(['middleware' => 'auth'], function() {
	Route::get('livro/cadastrar',	    ['as' => 'livro.cadastrar',	'uses' => 'LivroController@create']);
	Route::get('livro/consultar',	    ['as' => 'livro.consultar',	'uses' => 'LivroController@index']);
	Route::post('livro/gravar', 	    ['as' => 'livro.gravar',	'uses' => 'LivroController@store']);
	Route::post('livro/gravar-ponto', 	['as' => 'livro.gravarPonto',	'uses' => 'LivroController@storePonto']);
	Route::get('livro/ponto', 		    ['as' => 'livro.ponto',		'uses' => 'LivroController@ponto']);
});

/* Admin group */
Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
	Route::get('temas',             ['as' => 'admin.temas', 'uses' => 'TemaController@index']);
    Route::get('tema/ver/{id}',     'TemaController@show');
    Route::get('tema/apagar/{id}',  'TemaController@destroy');
    Route::get('tema/cadastrar',    'TemaController@create');
    Route::post('tema/gravar',       'TemaController@store');
    Route::post('tema/atualizar',   'TemaController@update');
});