<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Ponto;

class PontoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pontos = Ponto::has('livros')->get();
        return view('ponto.index', compact('pontos'));
	}


	public function livros($id)
	{
		$livros = Ponto::find($id)->livros;
        return view('livro.index', compact('livros'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ponto = Ponto::find($id);
        return view('ponto.visualizar', compact('ponto'));
	}

}
