<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use File;
use App\Livro;
use App\Emprestimo;
use App\Status;
use App\User;

class EmprestimoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
        $livro = Livro::find($id);
		return view('emprestimo.index', compact('livro'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $emprestimo = new Emprestimo();
        $livro = Livro::find($request->input('id'));

        $emprestimo->fill($request->input());

        $emprestimo->livro()->associate($livro);
        $emprestimo->status()->associate(Status::where('nome', 'Solicitado')->first());
        $emprestimo->dono()->associate($livro->dono);
        $emprestimo->solicitante()->associate(User::find(Auth::user()->id));

        $emprestimo->save();

        return redirect()
            ->route('livro.consultar')
            ->withInput(['cadastro' => 'Pedido de livro realizado com sucesso']);
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

}
