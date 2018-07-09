<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(MarkSteps\User::class, function (Faker $faker) {
    return [
        'name' => "AdminDemo", //$faker->name,
        'email' => "tech@ht2ml.com.br",
        'level' => (int)1,
        'password' => crypt("ht2ml"), // secret
        'remember_token' => str_random(10),
    ];
});
