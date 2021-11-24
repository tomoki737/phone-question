<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;
use App\User;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(255),
        'solution' => $faker->boolean(),
        'user_id' => function () {
            return factory(User::class);
        },
    ];
});
