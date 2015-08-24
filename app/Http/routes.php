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

Route::get('/',             ['as' => 'home',            'uses' => 'HomeController@index']);
Route::get('auth/login',	['as' => 'auth.login',		'uses' => 'AuthController@login']);	
Route::get('auth/logout',	['as' => 'auth.logout',		'uses' => 'AuthController@logout']);	
Route::post('auth/login',	['as' => 'auth.postLogin',	'uses' => 'AuthController@postLogin']);	

Route::group(['middleware' => 'auth'], function() {
    // Ponto de troca
    Route::get('pontos',                ['as' => 'ponto.index',     'uses' => 'PontoController@index']);
    Route::get('ponto/ver/{id}',        ['as' => 'ponto.ver',       'uses' => 'PontoController@show']);
    Route::get('ponto/livros/{id}',     ['as' => 'ponto.livros',    'uses' => 'PontoController@livros']);

    // Livros
	Route::get('livro/cadastrar',	    ['as' => 'livro.cadastrar',     'uses' => 'LivroController@create']);
	Route::get('livro/consultar',	    ['as' => 'livro.consultar',     'uses' => 'LivroController@index']);
    Route::get('livro/busca',           ['as' => 'livro.busca',         'uses' => 'LivroController@search']);
	Route::post('livro/gravar', 	    ['as' => 'livro.gravar',        'uses' => 'LivroController@store']);
	Route::post('livro/gravar-ponto', 	['as' => 'livro.gravarPonto',   'uses' => 'LivroController@storePonto']);
	Route::get('livro/ponto', 		    ['as' => 'livro.ponto',         'uses' => 'LivroController@ponto']);
    Route::get('livro/ver/{id}',	    ['as' => 'livro.ver',           'uses' => 'LivroController@show']);

    // Empréstimos
    Route::get('emprestimo/meu',                    ['as' => 'emprestimo.meus_pedidos', 'uses' => 'EmprestimoController@pedidosMeus']);
    Route::get('emprestimo/solicitacoes',           ['as' => 'emprestimo.solicitacoes', 'uses' => 'EmprestimoController@pedidosParaMim']);
    Route::get('emprestimo/meu/ver/{id}',           ['as' => 'emprestimo.meu_pedido',   'uses' => 'EmprestimoController@meuPedido']);
    Route::get('emprestimo/solicitacao/ver/{id}',   ['as' => 'emprestimo.solicitacao',  'uses' => 'EmprestimoController@solicitacao']);
    Route::get('emprestimo/todos',                  ['as' => 'emprestimo.todos',        'uses' => 'EmprestimoController@todos']);
    Route::get('emprestimo/concluir',               ['as' => 'emprestimo.concluir',     'uses' => 'EmprestimoController@concluir']);
    Route::get('emprestimo/historico',              ['as' => 'emprestimo.historico',    'uses' => 'EmprestimoController@historico']);
    Route::get('emprestimo/apagar/{id}',            ['as' => 'emprestimo.apagar',       'uses' => 'EmprestimoController@destroy']);
    Route::get('emprestimo/update/{id}/{acao}',     ['as' => 'emprestimo.update',       'uses' => 'EmprestimoController@update']);
    Route::post('emprestimo/gravar',                ['as' => 'emprestimo.gravar',       'uses' => 'EmprestimoController@store']);
});

/* Admin group */
Route::group(['middleware' => ['auth', 'App\Http\Middleware\AdminMiddleware'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    // Temas
	Route::get('temas',             ['as' => 'admin.temas', 'uses' => 'TemaController@index']);
    Route::get('tema/ver/{id}',     'TemaController@edit');
    Route::get('tema/apagar/{id}',  'TemaController@destroy');
    Route::get('tema/cadastrar',    'TemaController@create');
    Route::post('tema/gravar',      'TemaController@store');
    Route::post('tema/atualizar',   'TemaController@update');

    // Livros
    Route::get('livros',             ['as' => 'admin.livros', 'uses' => 'LivroController@index']);
    Route::get('livros/validar',     ['as' => 'admin.validar', 'uses' => 'LivroController@showInvalid']);
    Route::get('livro/validar/{id}', 'LivroController@validar');
    Route::get('livro/ver/{id}',     'LivroController@edit');
    Route::get('livro/apagar/{id}',  'LivroController@destroy');
    Route::post('livro/atualizar',   'LivroController@update');

    // Pontos de troca
    Route::get('pontos',             ['as' => 'admin.pontos', 'uses' => 'PontoController@index']);
    Route::get('ponto/ver/{id}',     'PontoController@edit');
    Route::get('ponto/apagar/{id}',  'PontoController@destroy');
    Route::get('ponto/cadastrar',    'PontoController@create');
    Route::get('ponto/{id}/livros',  'PontoController@livros');
    Route::post('ponto/gravar',      'PontoController@store');
    Route::post('ponto/atualizar',   'PontoController@update');
});

function setActive($route, $class = '')
{
    return in_array(Route::currentRouteName(), $route) ? 'active' : $class;
}