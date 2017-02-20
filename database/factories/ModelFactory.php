<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Organisation;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Estate::class, function (Faker\Generator $faker) {
	static $organisation_id;
	static $manager_id;
	static $type;

	return [
		'organisation_id' => $organisation_id,
		'manager_id' => $manager_id,
		'type' => $type ?: $type = 'residencial',
		'name' => $faker->company,
		'lat' => $faker->latitude(),
		'lng' => $faker->longitude(),
		'ext_number' => $faker->buildingNumber,
		'street' => $faker->streetName,
		'district' => $faker->citySuffix,
		'city' => $faker->city,
		'state' => $faker->state,
		'country' => 'MX',
		// 'img' => $faker->imageUrl($width = 640, $height = 480)
	];

});

$factory->define(App\Section::class, function (Faker\Generator $faker) {
	static $estate_id;
	static $manager_id;
	static $name;

	return [
		'estate_id' => $estate_id,
		'manager_id' => $manager_id,
		'name' => $name,
		'state' => 'operational',
		// 'img' => $faker->imageUrl($width = 640, $height = 480)
	];

});

$factory->define(App\Unit::class, function (Faker\Generator $faker) {
	static $section_id;

	return [
		'section_id' => $section_id,
		'number' => $faker->buildingNumber,
		'balance' => '0.0',
		'status' => 'active'
	];

});
