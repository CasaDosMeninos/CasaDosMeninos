<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        
        App\User::create([
        	'name'		=> 'Rodrigo A.',
        	'email'		=> 'alves.wm@gmail.com',
        	'ponto_id'  => 2,
            'admin'     => 1
        ]);

        App\User::create([
            'name'		=> 'Thiago Silva',
            'email'		=> 'thipontosilva@gmail.com',
            'ponto_id'  => 1
        ]);
    }

}