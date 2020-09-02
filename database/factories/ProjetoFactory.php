<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Wordpress\Projeto;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Projeto::class, function (Faker $faker) {
    return [
        'data' => Carbon::now(),
        'post_title' => 'Post title',
        'slug'  => $faker->slug,
        'content' => 'Post content',
        'image' => $faker->slug,
    ];
});
