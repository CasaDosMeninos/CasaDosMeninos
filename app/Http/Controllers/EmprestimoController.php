<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Mail;
use DB;

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
	public function meusPedidos()
	{
        $emprestimos = Emprestimo::where('solicitante_id', Auth::user()->id)
            ->whereHas('status', function($q) { $q->where('nome', 'Solicitado'); })
            ->orWhereHas('status', function($q) { $q->where('nome', 'Emprestado'); })
            ->get();
        return view('emprestimo.meus_pedidos', compact('emprestimos'));
	}

    public function meuPedido($id)
    {
        $modo = 'pedido';
        $emprestimo = Emprestimo::find($id);
        $livro = $emprestimo->livro;
        return view('emprestimo.pedido', compact('emprestimo', 'livro', 'modo'));
    }

    public function paraMim()
    {

        $emprestimos = Emprestimo::where('dono_id', Auth::user()->id)
            ->whereHas('status', function($q) {
                $q->where('nome', 'Solicitado');
            })
            ->get();


        return view('emprestimo.para_mim', compact('emprestimos'));
    }

    public function solicitacao($id)
    {
        $modo = 'solicitacao';
        $emprestimo = Emprestimo::find($id);
        $livro = $emprestimo->livro;
        return view('emprestimo.pedido', compact('emprestimo', 'livro', 'modo'));
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

        // Envia e-mail
        Mail::send('emails.pedir', ['emprestimo' => $emprestimo], function($message) {
            $message->subject('Pedido de empréstimo de livro');
            $message->sender('admin@rasouza.com.br');
            $message->to('alves.wm@gmail.com');
        });

        return redirect()
            ->route('livro.consultar')
            ->withInput(['cadastro' => 'Pedido de livro realizado com sucesso']);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $acao)
	{
		$emprestimo = Emprestimo::find($id);

        if ($acao == 'aceitar') {
            $emprestimo->status()->associate(Status::where('nome', 'Emprestado')->first());
            $livro = $emprestimo->livro;
            $livro->status()->associate(Status::where('nome', 'Emprestado')->first());
            $livro->save();
            $emprestimo->save();
        }
        elseif ($acao == 'recusar') {
            $emprestimo->status()->associate(Status::where('nome', 'Recusado')->first());
            $emprestimo->save();
            $emprestimo->delete();
        }


        return redirect()
            ->route('emprestimo.solicitacoes')
            ->withInput(['cadastro' => 'Pedido atualizado com sucesso']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Emprestimo::destroy($id);

        return redirect()
            ->route('emprestimo.meus_pedidos')
            ->withInput(['cadastro' => 'Pedido cancelado com sucesso']);
	}

}
