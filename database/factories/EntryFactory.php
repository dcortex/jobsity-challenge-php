<?php

use App\Entry;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Entry::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
    ];
});
