<?php

use Illuminate\Database\Seeder;

class ObrasTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		// Borramos los datos de la tabla
		DB::table('obras')->delete();

		// Creamos obras aleatoriamente, 10 obras
		factory('anayzquierdo\Obra', 10)->create();
		
		$this->command->info('Tabla obras inicializada con datos!');
	}
}
