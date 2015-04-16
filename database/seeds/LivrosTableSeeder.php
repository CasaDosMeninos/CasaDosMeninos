<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class LivrosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('livros')->delete();

        TestDummy::times(20)->create('App\Livro');
    }

}