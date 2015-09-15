<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Livro;
use App\Tema;

class LivroController extends Controller {

	public function index()
	{
		$livros = Livro::all();
		return view('admin.livro.index', compact('livros'));
	}

	public function edit($id, Request $request)
	{
        $livro = Livro::find($id);
        $temas = Tema::all()->lists('nome', 'id');

        // Carrega info na Session para mudar o Ponto de Troca
        $request->session()->put('id', $livro->id);
        $request->session()->put('isbn', $livro->isbn);
        $request->session()->put('titulo', $livro->titulo);
        $request->session()->put('edicao', $livro->edicao);
        $request->session()->put('ano', $livro->ano);
        $request->session()->put('paginas', $livro->paginas);
        $request->session()->put('editora', $livro->editora);
        $request->session()->put('autor', $livro->autor);
        $request->session()->put('tema_id', $livro->tema_id);


        return view('admin.livro.visualizar', compact('livro', 'temas'));
	}


	public function update(Request $request)
	{
        $livro = Livro::find($request->input('id'));

        /** @noinspection PhpParamsInspection */
        $livro->tema()->associate(Tema::find($request->input('tema_id')));
        $livro->fill($request->input())->save();

        // Se o livro tiver imagem
        if ($request->file('imagem') != null && $request->file('imagem')->isValid()) {

            if (!\File::exists('livros'))
                \File::makeDirectory('livros');

            $nome = $livro->id . '.' . $request->file('imagem')->getClientOriginalExtension();
            $request->file('imagem')->move('livros', $nome);
            $livro->imagem = TRUE;
            $livro->update();
        }

        return redirect()
            ->route('admin.livros')
            ->withInput(['cadastro' => 'Livro editado com sucesso']);
	}

    public function updatePonto(Request $request)
    {
        $livro = Livro::find(Session::pull('id'));
        $livro->ponto()->associate(Ponto::find($request->get('ponto')));
        $livro->save();

        return redirect()
            ->route('admin.livros')
            ->withInput(['cadastro' => 'Ponto de troca alterado com sucesso']);
    }

	public function destroy($id)
	{
        $livro = Livro::find($id);
        $livro->emprestimos()->withTrashed()->forceDelete();
        $livro->delete();
        return redirect()
            ->route('admin.livros')
            ->withInput(['cadastro' => 'Livro deletado com sucesso']);
	}

    public function showInvalid() {
        $livros = Livro::where('validado', FALSE)->get();

        return view('admin.livro.index', compact('livros'));
    }

    public function validar($id) {
        $livro = Livro::find($id);
        $livro->validado = TRUE;
        $livro->save();

        return redirect()
            ->route('admin.validar')
            ->withInput(['cadastro' => 'Livro validado com sucesso']);
    }
}
