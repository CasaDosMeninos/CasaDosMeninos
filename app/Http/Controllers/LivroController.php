<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Session;

use App\User;
use App\Tema;
use App\Ponto;
use App\Livro;
use App\Status;
use App\Emprestimo;

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

	public function search(Request $request)
	{
		$search = $request->input('search');
		$livros = Livro::where('validado', TRUE)
			->where('titulo', 'LIKE', "%$search%")
			->orWhere('autor', 'LIKE', "%$search%")
			->where('validado', TRUE)
			->get();
		return view('livro.index', compact('livros'));
	}

    public function show($id)
    {
        $livro = Livro::find($id);

        // Verifica se já existe um pedido em andamento
        $emprestimo = Emprestimo::whereHas('status', function($q) { $q->where('nome', 'Solicitado'); })
            ->where('solicitante_id',  Auth::user()->id)
            ->where('livro_id',  $livro->id)
            ->count();
        return view('livro.visualizar', compact('livro', 'emprestimo'));
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
		$pontos = Ponto::where('privado', FALSE)->get();
		$act = 'LivroController@storePonto';
		return view('livro.ponto', compact('pontos', 'act'));
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

		        if (!\File::exists('livros'))
					\File::makeDirectory('livros');

				//$extensao = $request->file('imagem')->getClientOriginalExtension();
				$nome = sprintf('user_%d.jpg', Auth::user()->id);
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
     		$livro->status()->associate(Status::where('nome', 'Disponivel')->first());

			$livro->validado = $request->input('validado');
			$livro->fill($request->input())->save();

			// Se o livro tiver imagem
			if ($request->file('imagem') != null && $request->file('imagem')->isValid()) {
				$nome = $livro->id . '.jpg';
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

		$livro = new Livro;

		$livro->tema()->associate(Tema::find(Session::get('tema_id')));
		$livro->dono()->associate(User::find(Auth::user()->id));
		$livro->ponto()->associate(Ponto::find($request->get('ponto')));
		$livro->status()->associate(Status::where('nome', 'Disponivel')->first());

		$livro->validado = Session::get('validado');
		$livro->fill(Session::all())->save();

		if (Session::has('imagem')) {
			$imagem = Session::get('imagem');
			rename("livros/{$imagem['nome']}", "livros/{$livro->id}.jpg");
			$livro->imagem = TRUE;
			$livro->update();
		}

		return redirect()
				->route('livro.consultar')
				->withInput(['cadastro' => 'Cadastro de livro realizado com sucesso']);
	}



}
