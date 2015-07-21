<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ponto extends Model {

    protected $fillable = ['nome', 'endereco', 'bairro', 'cep', 'latitude', 'longitude', 'responsavel', 'contato'];

    public function livros() {
        return $this->hasMany('App\Livro', 'ponto_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'ponto_id');
    }
}
