<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Status as Status;

class StatusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('status')->delete();

        Status::create(['nome' => 'Disponível']);
        Status::create(['nome' => 'Emprestado']);
        Status::create(['nome' => 'Recusado']);
        Status::create(['nome' => 'Solicitado']);
        Status::create(['nome' => 'Concluido']);
    }

}