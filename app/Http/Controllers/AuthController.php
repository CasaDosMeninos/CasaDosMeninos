<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Adldap;
use App\User;
use App\Ponto;

class AuthController extends Controller {

    protected $username = 'mail';
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login()
    {
//        foreach (Adldap::search()->all() as $v) {
//            \Debugbar::info($v->cn);
//        }
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $s = Adldap::search()
            ->where('mail', '=', $request->input('email'))
            ->where('senha', '=', md5($request->input('senha')))
            ->first();
        if ($s) {
            $user = User::where('email', $request->input('email'))->first();
            if (count($user) == 0)
                $user = $this->createUser($s);

            Auth::login($user);
            return redirect()->intended('/');
        }

        return view('login')
            ->withInput($request->only('email'))
            ->withErrors(['login' => 'E-mail/senha inválidos']);   
    }

    public function logout()
    {
        Auth::logout();
        return view('login');
    }

    public function createUser($entry) {
        $ponto = Ponto::create([
            'nome' => "Casa do {$entry->sn[0]}",
            'endereco' => $entry->homepostaladdress[0],
            'bairro' => '',
            'cep' => $entry->postalcode[0]
        ]);
        $ponto->privado(true)->save();

        $user = new User();
        $user->name = $entry->sn[0];
        $user->email = $entry->mail[0];
        $user->ponto()->associate($ponto);
        $user->save();

        return $user;
    }
}