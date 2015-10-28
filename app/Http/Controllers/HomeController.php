<?php namespace App\Http\Controllers;

use Adldap;
use Auth;
use App\User;
use App\Emprestimo;
use Illuminate\Support\Facades\Session;

use Mail;
class HomeController extends Controller {

	public function index()
    {
        Mail::send('emails.pedir', [], function($message) {
            $message->subject('Pedido de empréstimo de livro');
            $message->sender('admin@rasouza.com.br');
            $message->to('alves.wm@gmail.com');
        });
		return view('home');
	}

    public function perfil()
    {
        $user = Adldap::search()->where('mail', '=', Auth::user()->email)->first();
        $model = User::find(Auth::user()->id);
        $modo = 'todos';
        $emprestimos = Emprestimo::onlyTrashed()
            ->where(function($q) {
                $q->where('dono_id', Auth::user()->id);
                $q->orWhere('solicitante_id', Auth::user()->id);
            })
            ->get();
        return view('perfil', compact('user', 'model', 'modo', 'emprestimos'));
    }

    public function perfilAlheio($id)
    {
        $user = Adldap::search()->where('mail', '=', Auth::user()->email)->first();
        $model = User::find($id);
        $modo = 'todos';
        $alheio = true;
        $emprestimos = Emprestimo::onlyTrashed()
            ->where(function($q) {
                $q->where('dono_id', Auth::user()->id);
                $q->orWhere('solicitante_id', Auth::user()->id);
            })
            ->get();
        return view('perfil', compact('user', 'model', 'modo', 'emprestimos', 'alheio'));
    }

    public function livros($id)
    {
        $livros = User::find($id)->livros;
        return view('livro.index', compact('livros'));
    }
}