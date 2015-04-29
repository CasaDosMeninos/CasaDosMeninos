<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('livros', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tema_id');
            $table->foreign('tema_id')->references('id')->on('temas');
            $table->unsignedInteger('dono_id');
            $table->foreign('dono_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('isbn')->nullable();
            $table->string('titulo');
            $table->integer('edicao')->nullable();
            $table->integer('ano')->nullable();
            $table->integer('paginas')->nullable();
            $table->string('editora')->nullable();
            $table->string('autor');
            $table->boolean('imagem')->default(FALSE);
            $table->boolean('validado');
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
		Schema::drop('livros');
	}

}
