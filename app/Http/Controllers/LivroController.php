<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Session;
use File;

use App\User;
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
		$livros = Livro::where('validado', TRUE)->get();
		return view('livro.index', compact('livros'));
	}

    public function show($id)
    {
        $livro = Livro::find($id);
        return view('livro.visualizar', compact('livro'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$temas = Tema::all()->lists('nome', 'id');
		return view('livro.cadastrar', compact('temas'));
	}

	/**
	 * Mostra os possiveis pontos de troca para o livro que está sendo cadastrado.
	 *
	 * @return Response
	 */
	public function ponto(Request $request)
	{
		$request->flash();
		$pontos = Ponto::where('privado', FALSE)->get();
		return view('livro.ponto', compact('pontos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{


		// Se o tipo do ponto não for a casa do dono, ainda há mais um passo no formulário
		if ($request->input('tipo-ponto') == 'fora') {
			if ($request->file('imagem') != null && $request->file('imagem')->isValid()) {

                if (!File::exists('livros'))
                    \File::makeDirectory('livros');

				$extensao = $request->file('imagem')->getClientOriginalExtension();
				$nome = sprintf('user_%d.%s', Auth::user()->id, $extensao);
				$request->file('imagem')->move('livros', $nome);

				// Salva na sessão para renomear futuramente
				session(['imagem' => ['nome' => $nome, 'extensao' => $extensao]]);
			}
			session($request->except('_token', 'tipo-ponto', 'imagem'));
			return redirect()->route('livro.ponto');
		} else {
			$livro = new Livro;

			// Foreign Keys
			$livro->tema()->associate(Tema::find($request->input('tema_id')));
			$livro->dono()->associate(User::find(Auth::user()->id));
			$livro->ponto()->associate(Ponto::find(Auth::user()->ponto_id));

			$livro->fill($request->input())->save();

			// Se o livro tiver imagem
			if ($request->file('imagem') != null && $request->file('imagem')->isValid()) {
				$nome = $livro->id . '.' . $request->file('imagem')->getClientOriginalExtension();
				$request->file('imagem')->move('livros', $nome);
				$livro->imagem = TRUE;
				$livro->update();
			}

			return redirect()
					->route('livro.consultar')
					->withInput(['cadastro' => 'Cadastro de livro realizado com sucesso']);
		}
	}

	public function storePonto(Request $request)
	{
        $msg = $route = '';

        // Se já existir ID então estou editando o ponto de troca
        if (Session::get('id') == null) {
            $livro = new Livro;

            $livro->tema()->associate(Tema::find(Session::get('tema_id')));
            $livro->dono()->associate(User::find(Auth::user()->id));
            $livro->ponto()->associate(Ponto::find($request->get('ponto')));

            $livro->fill(Session::all())->save();

            if (Session::has('imagem')) {
                $imagem = Session::get('imagem');
                rename("livros/{$imagem['nome']}", "livros/{$livro->id}.{$imagem['extensao']}");
                $livro->imagem = TRUE;
                $livro->update();
            }

            $msg = 'Cadastro de livro realizado com sucesso';
            $route = 'livro.consultar';
        } else {
            $livro = Livro::find(Session::pull('id'));
            $livro->ponto()->associate(Ponto::find($request->get('ponto')));
            $livro->save();

            $msg = 'Ponto de troca alterado com sucesso';
            $route = 'admin.livros';
        }


		return redirect()
				->route($route)
				->withInput(['cadastro' => $msg]);
	}


	
}
