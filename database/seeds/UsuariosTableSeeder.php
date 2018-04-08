<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Borramos los datos de la tabla
    DB::table('usuarios')->delete();

    // Creamos 1 administrador...
    factory('anayzquierdo\Usuario', 'admin', 1)->create();

    //...y 10 clientes aleatoriamente
    factory('anayzquierdo\Usuario', 10)->create();

    $this->command->info('Tabla usuarios inicializada con datos!');
  }

}
