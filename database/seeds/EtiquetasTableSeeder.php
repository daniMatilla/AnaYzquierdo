<?php

use Illuminate\Database\Seeder;

class EtiquetasTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {

    // Borramos los datos de la tabla
    DB::table('etiquetas')->delete();

    // Creamos obras aleatoriamente, 20 etiquetas
    factory('anayzquierdo\Etiqueta', 20)->create();
    
    $this->command->info('Tabla etiquetas inicializada con datos!');
  }
}
