<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPontosToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) 
		{
            $table->unsignedInteger('ponto_id')->after('id');
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
		Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_ponto_id_foreign');
			$table->dropColumn('ponto_id');
        });
	}

}
