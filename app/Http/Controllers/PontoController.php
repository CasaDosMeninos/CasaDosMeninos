<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Ponto;

class PontoController extends Controller {

	public function index()
	{
		$pontos = Ponto::has('livros')
			->orWhere('privado', false)
			->get();
        return view('ponto.index', compact('pontos'));
	}


	public function livros($id)
	{
		$livros = Ponto::find($id)->livros;
        return view('livro.index', compact('livros'));
	}

	public function show($id)
	{
		$ponto = Ponto::find($id);
        return view('ponto.visualizar', compact('ponto'));
	}

}
