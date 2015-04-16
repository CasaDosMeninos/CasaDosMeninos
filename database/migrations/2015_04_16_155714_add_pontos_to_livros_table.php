<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPontosToLivrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('livros', function(Blueprint $table)
		{
			$table->unsignedInteger('ponto_id')->after('dono_id');
            $table->foreign('ponto_id')->references('id')->on('pontos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('livros', function(Blueprint $table)
		{
			$table->dropForeign('livros_ponto_id_foreign');
			$table->dropColumn('ponto_id');
		});
	}

}
