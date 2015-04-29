<?php namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller {

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user) {
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

}