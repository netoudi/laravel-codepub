<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \Modules\CodeBook\Models\Category::all();

        factory(\Modules\CodeBook\Models\Book::class, 50)->create()->each(function ($book) use ($categories) {
            $categoriesRandom = $categories->random(mt_rand(1, 5));
            $book->categories()->sync($categoriesRandom->pluck('id')->all());
        });
    }
}
