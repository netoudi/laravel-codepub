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
        factory(\CodePub\Models\User::class, 1)->create([
            'name' => 'Admin',
            'email' => 'admin@codepub.com',
        ]);

        factory(\CodePub\Models\User::class, 1)->create([
            'name' => 'Author One',
            'email' => 'author1@codepub.com',
        ]);

        factory(\CodePub\Models\User::class, 1)->create([
            'name' => 'Author Two',
            'email' => 'author2@codepub.com',
        ]);

        factory(\CodePub\Models\User::class, 12)->create();
    }
}
