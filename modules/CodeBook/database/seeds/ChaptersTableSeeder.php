<?php

use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = \Modules\CodeBook\Models\Book::all();

        foreach ($books as $book) {
            factory(\Modules\CodeBook\Models\Chapter::class, 5)->make()->each(function ($chapter) use ($book) {
                $chapter->book_id = $book->id;
                $chapter->save();
            });
        }
    }
}
