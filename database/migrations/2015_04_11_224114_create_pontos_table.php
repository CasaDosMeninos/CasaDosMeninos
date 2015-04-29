<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePontosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pontos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('endereco');
            $table->string('bairro');
            $table->integer('cep');
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->string('responsavel')->nullable();
            $table->string('contato')->nullable();
            $table->string('autorizacao')->nullable();
            $table->boolean('privado')->default(FALSE);
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pontos');
	}

}
