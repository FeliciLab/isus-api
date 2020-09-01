<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Wordpress\Projeto;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Projeto::class, function (Faker $faker) {
    return [
        'id' => $faker->randomDigit,
        'data' => Carbon::now(),
        'post_title' => $faker->realText(100),
        'slug'  => $faker->slug,
        'content' => $faker->text,
        'image' => $faker->slug,
    ];
});
