<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetPedidosTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('det_pedidos', function (Blueprint $table) {
      $table->engine = 'InnoDB';

      $table->increments('id_det_pedido');
      $table->integer('id_pedido')->unsigned();
      $table->decimal('precio', 6, 2);
      $table->integer('cantidad');
      // $table->integer('id_usuario')->unsigned();
      $table->integer('id_obra')->unsigned();
      $table->timestamps();

      $table->foreign('id_pedido')
        ->references('id_pedido')
        ->on('pedidos')
        ->onDelete('cascade');

      // $table->foreign('id_usuario')
      //   ->references('id_usuario')
      //   ->on('usuarios')
      //   ->onDelete('cascade');

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
    Schema::table('det_pedidos', function (Blueprint $table) {
      $table->dropForeign('det_pedidos_id_pedido_foreign');
      // $table->dropForeign('det_pedidos_id_usuario_foreign');
      $table->dropForeign('det_pedidos_id_obra_foreign');
    });

    Schema::dropIfExists('det_pedidos');

  }
}
