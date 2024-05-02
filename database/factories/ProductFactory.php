<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        // 'user_id' => '',
        'description' => $faker->text(200),
        'price' => $faker->numberBetween(10000, 150000),
        'image' => ''
    ];
});
