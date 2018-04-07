<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('usuarios', function (Blueprint $table) {
      $table->engine = 'InnoDB';

      $table->increments('id_usuario');
      $table->string('email')->unique();
      $table->string('password');
      $table->string('avatar')->nullable()->default('');
      $table->string('nombre', 20);
      $table->string('apellidos', 50)->nullable()->default('');
      $table->string('telefono', 9)->nullable()->default('');
      $table->string('direccion')->nullable()->default('');
      $table->string('poblacion')->nullable()->default('');
      $table->string('cp', 5)->nullable()->default('');
      $table->string('provincia')->nullable()->default('');
      $table->enum('rol', ['admin', 'cliente'])->default('cliente');
      $table->boolean('activo')->default(false);
      $table->boolean('bloqueado')->default(false);
      $table->string('confirm_token', 100);
      $table->string('saludo', 191)->nullable()->default('anayzquierdo.com');
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('usuarios');
  }
}
