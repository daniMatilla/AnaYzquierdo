<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id_obra');
            $table->string('titulo_obra', 50)->unique();
            $table->string('imagen', 100)->unique();
            $table->string('tecnica', 20)->nullable();
            $table->string('soporte', 20)->nullable();
            $table->integer('largo')->nullable();
            $table->integer('alto')->nullable();
            $table->decimal('precio', 6, 2);
            $table->boolean('vendida')->default(false);
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
        Schema::dropIfExists('obras');
    }
}
