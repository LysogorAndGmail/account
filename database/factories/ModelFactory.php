<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'lname'             => $faker->firstName,
        'lname'             => $faker->lastName,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token'    => str_random(10),
    ];
});

$factory->define(App\Organization::class, function (Faker $faker) {
    return [
        'name'    => $faker->name,
        'address' => $faker->address,
        'phone'   => $faker->phoneNumber,
        'email'   => $faker->unique()->safeEmail,
        'reg'     => rand(32343243, 9879875487),
        'vat'     => rand(32343243, 9879875487)
    ];
});
