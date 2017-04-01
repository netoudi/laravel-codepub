<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Modules\CodeBook\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(\Modules\CodeBook\Models\Book::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 15),
        'title' => $faker->unique()->sentence,
        'subtitle' => $faker->sentence(5, true),
        'price' => $faker->randomFloat(null, 10, 100),
    ];
});

$factory->define(\Modules\CodeBook\Models\Chapter::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
        'content' => $faker->paragraph(10),
    ];
});
