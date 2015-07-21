<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Livro;
use App\Ponto;
use Illuminate\Http\Request;

use App\Tema;

class PontoController extends Controller {

    public function livros($id)
    {
        $ponto = Ponto::find($id);
        $livros = $ponto->livros;
        return view('admin.ponto.livros', compact('ponto', 'livros'));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $pontos = Ponto::where('privado', FALSE)->get();
        return view('admin.ponto.index', compact('pontos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.ponto.cadastrar');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $ponto = new Ponto();
        $ponto->fill($request->input())->save();

        if ($request->file('autorizacao') != null && $request->file('autorizacao')->isValid()) {
            $nome = $ponto->id . '.' . $request->file('autorizacao')->getClientOriginalExtension();
            $request->file('autorizacao')->move('autorizacao', $nome);
        }

        return redirect()
            ->route('admin.pontos')
            ->withInput(['cadastro' => 'Livro cadastrado com sucesso']);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
    {
        $ponto = Ponto::find($id);
        return view('admin.ponto.visualizar', compact('ponto'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
        $ponto = Ponto::find($request->id);
        $ponto->fill($request->input())->save();

        if ($request->file('autorizacao') != null && $request->file('autorizacao')->isValid()) {
            $nome = $ponto->id . '.' . $request->file('autorizacao')->getClientOriginalExtension();
            $request->file('autorizacao')->move('autorizacao', $nome);
        }

        return redirect()
            ->route('admin.pontos')
            ->withInput(['cadastro' => 'Ponto de troca editado com sucesso']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $ponto = Ponto::find($id);
        if (count($ponto->livros) > 0)
            $ponto->livros()->delete();

        Ponto::destroy($id);
        return redirect()
            ->route('admin.pontos')
            ->withInput(['cadastro' => 'Ponto de troca deletado com sucesso']);
	}

}
