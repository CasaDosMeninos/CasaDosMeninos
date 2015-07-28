<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Mail;
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
        $emprestimo = Emprestimo::where('solicitante_id', Auth::user()->id)->get();
        return view('emprestimo.meus_pedidos', compact('emprestimo'));
	}

    public function meuPedido($id)
    {
        $emprestimo = Emprestimo::find($id);
        $livro = $emprestimo->livro;
        return view('emprestimo.meu_pedido', compact('emprestimo', 'livro'));
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
        Emprestimo::destroy($id);

        return redirect()
            ->route('emprestimo.meus_pedidos')
            ->withInput(['cadastro' => 'Pedido cancelado com sucesso']);
	}

}
