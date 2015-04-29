<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use App\Ponto;
use Laracasts\TestDummy\Factory as TestDummy;

class PontosTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
    	Ponto::create([
    		'nome'		=> 'Casa dos Meninos',
    		'endereco'	=> 'R. Yoshimara Minamoto, 656B',
    		'bairro'	=> 'Jardim Brasilia',
    		'cep'		=> '05847620',
    		'latitude'	=> -23.653026,
    		'longitude'	=> -46.747006
    	]);

        Ponto::create([
            'nome'      => 'Casa do Rodrigo',
            'endereco'  => 'R. Utuamba,56',
            'bairro'    => 'Jardim Brasilia',
            'cep'       => '05846430',
            'latitude'  => -23.649742,
            'longitude' => -46.748515,
            'privado'   => TRUE
        ]);
    }

}