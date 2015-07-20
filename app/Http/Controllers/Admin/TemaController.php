<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Tema;

class TemaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$temas = Tema::all();
		return view('admin.tema.index', compact('temas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        return view('admin.tema.cadastrar');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$tema = new Tema();
        $tema->nome = $request->input('nome');
        $tema->save();

        return redirect()
            ->route('admin.temas')
            ->withInput(['cadastro' => 'Tema cadastrado com sucesso']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $tema = Tema::find($id);
		return view('admin.tema.visualizar', compact('tema'));
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
	public function update(Request $request)
	{
        $tema = Tema::find($request->id);
        $tema->nome = $request->nome;
        $tema->save();

        return redirect()
            ->route('admin.temas')
            ->withInput(['cadastro' => 'Tema editado com sucesso']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Tema::destroy($id);
        return redirect()
            ->route('admin.temas')
            ->withInput(['cadastro' => 'Tema deletado com sucesso']);
	}

}
