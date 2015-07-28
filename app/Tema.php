<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model {

	public function livros() {
        return $this->hasMany('App\Livro', 'tema_id');
    }

}
