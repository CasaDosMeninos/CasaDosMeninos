<?php 



$factory('App\User', [
    'name'	=> $faker->name,
    'email'	=> $faker->email
]);

$factory('App\Livro', [
	'tema_id'	=> App\Tema::first()->id,
	'dono_id'	=> App\User::first()->id,
	'ponto_id'	=> App\Ponto::first()->id,
	'isbn'		=> $faker->randomNumber(8),
	'titulo'	=> $faker->words(3),
	'edicao'	=> $faker->randomDigit,
	'ano'		=> $faker->year,
	'paginas'	=> $faker->randomNumber(3),
	'editora'	=> $faker->company,
	'autor'		=> $faker->name,
	'validado'	=> TRUE
]);

?>