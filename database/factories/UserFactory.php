<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

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

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;
    $now = Carbon::now()->toDateTimeString();

    return [
        'username' => $faker->unique()->name,
        'ni_cheng' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('11111111'),
        'created_at' => $now,
        'updated_at' => $now,
        'iconpath' => "/img/default.png",
        'authority' => 0,
    ];
});
