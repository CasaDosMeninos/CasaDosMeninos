<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Tema as Tema;

class TemasTableSeeder extends Seeder {

    public function run()
    {
        DB::table('temas')->delete();

        Tema::create(['nome' => 'História']);
        Tema::create(['nome' => 'Geografia']);
        Tema::create(['nome' => 'Ciências']);
        Tema::create(['nome' => 'Português']);
        Tema::create(['nome' => 'Matemática']);
        Tema::create(['nome' => 'Inglês']);
        Tema::create(['nome' => 'Química']);
        Tema::create(['nome' => 'Física']);
    }

}