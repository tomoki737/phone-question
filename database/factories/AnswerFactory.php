<?php

use App\Answer;
use App\Question;
use Faker\Generator as Faker;
use App\User;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->text(255),
        'question_id' => function () {
            return factory(Question::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
