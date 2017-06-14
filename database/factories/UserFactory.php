<?php

use App\Models\User;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    $user = User::all()->first();
    return [
        'id' => $faker->uuid,
        'username' => 'Mr Test',
        'email' => 'khanhpoly@gmail.com',
        'password' => bcrypt('password'),
        'status' => '0',
        'access_token' => "D0NaNVz43YzjitVlekIU",
        'remember_token' => str_random(20)
    ];
});