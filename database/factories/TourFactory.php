<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tour;
use App\Models\Location;
use App\Models\Seo;
use Faker\Generator as Faker;

$factory->define(Tour::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'url' => $faker->slug,
        'description' => $faker->text($maxNbChars = 200),
        'location_id' => Location::orderByRaw('RAND()')->first()->id,
        'duration' => '03:00',
        'is_live' => $faker->boolean,
        'is_promoted' => $faker->boolean,
        'seo_id' => factory(Seo::class)->create()->id,
        'booking_count' => $faker->randomDigitNotNull
    ];
});
