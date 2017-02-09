<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Modules\CodeUser\Models\User::class, 1)->create([
            'name' => 'Author One',
            'email' => 'author1@codepub.com',
        ]);

        factory(\Modules\CodeUser\Models\User::class, 1)->create([
            'name' => 'Author Two',
            'email' => 'author2@codepub.com',
        ]);

        factory(\Modules\CodeUser\Models\User::class, 12)->create();
    }
}
