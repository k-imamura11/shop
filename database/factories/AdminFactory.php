<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('qwer22535'), // secret
        'address' => $faker->address,
        // 'remember_token' => str_random(10),
    ];
});
