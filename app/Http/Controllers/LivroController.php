<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Tema;
use App\Ponto;
use App\Livro;

class LivroController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// @TODO: Errado! Apenas mostrar os validados
		$livros = Livro::all();
		return view('livro.index', compact('livros'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$pontos = Ponto::all();
		
		$temas = Tema::all()->lists('nome', 'id');
		return view('livro.cadastrar', compact('temas', 'pontos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		if ($request->input('tipo-ponto') == 'fora') {
			return redirect()->route('livro.ponto')->withInput($request->except('_token', 'tipo-ponto'));
		} else {
			$tema = Tema::find($request->input('tema_id'));
			\Debugbar::info($tema);

			$livro = new Livro;
			$livro->tema()->associate($tema);
			\Debugbar::info($livro);
			return view('home');
		}



		// return redirect()->route('livro.consultar');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Mostra os possiveis pontos de troca para o livro que está sendo cadastrado.
	 *
	 * @return Response
	 */
	public function ponto(Request $request)
	{
		\Debugbar::info($request->old());

		$pontos = Ponto::all();
		return view('livro.ponto', compact('pontos'));
	}
}
