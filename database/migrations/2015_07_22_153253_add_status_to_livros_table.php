<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToLivrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('livros', function(Blueprint $table) {
            $table->unsignedInteger('status_id')->after('id');
            $table->foreign('status_id')->references('id')->on('status');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('livros', function(Blueprint $table) {
            $table->dropForeign('livros_status_id_foreign');
            $table->dropColumn('status_id');
        });
	}

}
