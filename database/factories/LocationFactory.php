<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Location;
use App\Models\City;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'url' => $faker->url,
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'city_id' => City::orderByRaw('RANDOM()')->first()->id,
    ];
});
