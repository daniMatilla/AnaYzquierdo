<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('favoritos', function (Blueprint $table) {
			$table->engine = 'InnoDB';

			$table->increments('id_favorito');
			$table->integer('id_usuario')->unsigned();
			$table->integer('id_obra')->unsigned();
			$table->timestamps();

			$table->foreign('id_usuario')
				->references('id_usuario')
				->on('usuarios')
				->onDelete('cascade');

			$table->foreign('id_obra')
				->references('id_obra')
				->on('obras')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('favoritos', function (Blueprint $table) {
			$table->dropForeign('favoritos_id_usuario_foreign');
			$table->dropForeign('favoritos_id_obra_foreign');
		});

		Schema::dropIfExists('favoritos');
	}
}
