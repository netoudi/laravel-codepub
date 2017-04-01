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
        \Artisan::call('codeuser:make-permissions');

        factory(\Modules\CodeUser\Models\User::class, 20)->create();
    }
}
