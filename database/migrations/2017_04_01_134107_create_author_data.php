<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAuthorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        factory(\Modules\CodeUser\Models\User::class, 1)->create([
            'name' => config('codebook.author_default.name'),
            'email' => config('codebook.author_default.email'),
            'password' => bcrypt(config('codebook.author_default.password')),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        $user = \Modules\CodeUser\Models\User::where('email', config('codebook.author_default.email'))->first();
        $user->forceDelete();

        Schema::enableForeignKeyConstraints();
    }
}
