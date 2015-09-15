<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'users';
    protected $hidden = ['remember_token'];
    protected $fillable = ['name', 'email'];

    public function ponto()
    {
    	return $this->belongsTo('App\Ponto', 'ponto_id');
    }

    public function livros()
    {
        return $this->hasMany('App\Livro', 'dono_id');
    }
}
