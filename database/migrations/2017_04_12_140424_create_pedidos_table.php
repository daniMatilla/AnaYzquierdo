<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pedidos', function (Blueprint $table) {
			$table->engine = 'InnoDB';

			$table->increments('id_pedido');
			$table->decimal('subtotal', 6,2);
			$table->decimal('envio', 5,2)->nullable();
			$table->integer('id_usuario')->unsigned();
			$table->dateTime('fecha_alta');
			$table->dateTime('fecha_cierre')->nullable();
			$table->enum('estado', ['a', 'c'])->default('a');
			$table->timestamps();

			$table->foreign('id_usuario')
				->references('id_usuario')
				->on('usuarios')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('pedidos', function (Blueprint $table) {
			$table->dropForeign('pedidos_id_usuario_foreign');
		});

		Schema::dropIfExists('pedidos');
	}
}
