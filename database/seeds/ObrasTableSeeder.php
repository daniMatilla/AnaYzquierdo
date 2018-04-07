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

		// Creamos obras aleatoriamente, 49 obras
		factory('anayzquierdo\Obra', 49)->create();
		
		$this->command->info('Tabla obras inicializada con datos!');
	}
}
