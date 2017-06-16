<?php

use App\Models\AlertGroup;
use App\Models\User;

$factory->define(AlertGroup::class, function (Faker\Generator $faker) {
    factory(User::class, 1)->create();
    $user = User::all()->first();
    return [
        'id' => $faker->uuid,
        'name' => 'Group1',
        'user_id' => $user->id
    ];
});
