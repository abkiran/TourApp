<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Seo;
use Faker\Generator as Faker;

$factory->define(Seo::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text($maxNbChars = 160),
        'keywords' => $faker->words($nb = 5, $asText = true)
    ];
});
