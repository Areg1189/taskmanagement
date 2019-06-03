<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use Faker\Generator as Faker;

$factory->define(\App\Models\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'deadline' => $faker->dateTimeBetween('now', \Carbon\Carbon::now()->addYear(1)->timestamp),
    ];
});
