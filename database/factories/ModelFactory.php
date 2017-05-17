<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
| https://github.com/fzaninotto/Faker
|
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
/*
$factory->define(anayzquierdo\User::class, function (Faker\Generator $faker) {
static $password;

return [
'name' => $faker->name,
'email' => $faker->unique()->safeEmail,
'password' => $password ?: $password = bcrypt('secret'),
'remember_token' => str_random(10),
];
});
 */

// Definición de Usuarios aleatorios
$factory->define(anayzquierdo\Usuario::class, function (Faker\Generator $faker) {
	$faker = Faker\Factory::create('es_ES');
	static $nombre;

	return [
		'email' => $faker->unique()->email,
		'nombre' => $nombre = $faker->firstName,
		'password' => bcrypt(strtolower($nombre)),
		'avatar' => '',
		'apellidos' => $faker->lastName . ' ' . $faker->lastName,
		'telefono' => rand(600000000, 999999999),
		'direccion' => $faker->streetAddress,
		'poblacion' => $faker->city,
		'cp' => $faker->postcode,
		'provincia' => $faker->state,
		'rol' => 'cliente',
		'activo' => $faker->boolean($chanceOfGettingTrue = 30),
		'bloqueado' => $faker->boolean($chanceOfGettingTrue = 10),
		'confirm_token' => str_random(100),
		'remember_token' => str_random(100),
	];
});


// Definición de administrador
$factory->defineAs(anayzquierdo\Usuario::class, 'admin', function (Faker\Generator $faker) {
	$faker = Faker\Factory::create('es_ES');
	static $nombre;

	return [
		'email' => 'dani@mail.com',
		'nombre' => $nombre = 'Daniel',
		'password' => bcrypt(strtolower($nombre)),
		'avatar' => '',
		'apellidos' => $faker->lastName . ' ' . $faker->lastName,
		'telefono' => rand(600000000, 999999999),
		'direccion' => $faker->streetAddress,
		'poblacion' => $faker->city,
		'cp' => $faker->postcode,
		'provincia' => $faker->state,
		'rol' => 'admin',
		'activo' => true,
		'bloqueado' => false,
		'confirm_token' => str_random(100),
		'remember_token' => str_random(100),
	];
});

//Definición de Obras aleatorias
$factory->define(anayzquierdo\Obra::class, function (Faker\Generator $faker) {
	$faker = Faker\Factory::create('es_ES');
	static $imagen;
	$imagen = $imagen ? $imagen + 1 : 1;

	return [
		'titulo_obra' => $faker->firstNameFemale . '_' . $imagen,
		'imagen' => 'images/obras/' . $imagen . '.jpg',
		'tecnica' => $faker->firstNameFemale,
		'soporte' => $faker->firstNameMale,
		'largo' => rand(100, 999),
		'alto' => rand(100, 999),
		'precio' => $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 999),
		'vendida' => $faker->boolean($chanceOfGettingTrue = 45),
	];
});