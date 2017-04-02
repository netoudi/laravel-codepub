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
            $chapters = factory(\Modules\CodeBook\Models\Chapter::class, 5)->make();

            foreach ($chapters as $key => $chapter) {
                $chapter->book_id = $book->id;
                $chapter->order = $key + 1;
                $chapter->save();
            }
        }
    }
}
