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
    $repository = app(\Modules\CodeUser\Repositories\UserRepository::class);
    /** @var \Illuminate\Database\Eloquent\Collection $authorId */
    $authorId = $repository->all()->random()->id;

    return [
        'user_id' => $authorId,
        'title' => $faker->unique()->sentence,
        'subtitle' => $faker->sentence(5, true),
        'price' => $faker->randomFloat(2, 10, 100),
        'dedication' => $faker->sentence,
        'description' => $faker->paragraph,
        'website' => $faker->url,
        'percent_complete' => rand(0, 100),
        'published' => $faker->boolean,
    ];
});

$factory->define(\Modules\CodeBook\Models\Chapter::class, function (Faker\Generator $faker) {
    $faker->addProvider(new \Modules\CodeBook\Faker\ChapterFakerProvider($faker));

    return [
        'name' => $faker->sentence(2),
        'content' => $faker->markdown(rand(2, 6)),
    ];
});
