<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmprestimosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emprestimos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->integer('livro_id');
            $table->foreign('livro_id')->references('id')->on('livros');
            $table->integer('owner_id');
            $table->foreign('owner_id')->references('id')->on('owners');
            $table->integer('solicitante_id');
            $table->foreign('solicitante_id')->references('id')->on('solicitantes');
            $table->integer('ponto');
            $table->foreign('ponto')->references('id')->on('pontos');
            $table->date('data');
            $table->text('obs')->nullable();
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
		Schema::drop('emprestimos');
	}

}
