<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasObrasTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('clas_obras', function (Blueprint $table) {
			$table->engine = 'InnoDB';

			$table->increments('id_clas_obra');
			$table->integer('id_obra')->unsigned();
			$table->integer('id_etiqueta')->unsigned();
			$table->timestamps();

			$table->foreign('id_obra')
				->references('id_obra')
				->on('obras')
				->onDelete('cascade');

			$table->foreign('id_etiqueta')
				->references('id_etiqueta')
				->on('etiquetas')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('clas_obras', function (Blueprint $table) {
			$table->dropForeign('clas_obras_id_obra_foreign');
			$table->dropForeign('clas_obras_id_etiqueta_foreign');
		});

		Schema::dropIfExists('clas_obras');
	}
}
