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


Route::get('livro/cadastrar', ['as' => 'livro.cadastrar', 'uses' => 'LivroController@create']);
Route::get('livro/consultar', ['as' => 'livro.consultar', 'uses' => 'LivroController@index']);



