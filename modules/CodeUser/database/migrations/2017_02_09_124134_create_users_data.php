<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        factory(\Modules\CodeUser\Models\User::class, 1)->create([
            'name' => config('codeuser.user_default.name'),
            'email' => config('codeuser.user_default.email'),
            'password' => bcrypt(config('codeuser.user_default.password')),
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

        $user = \Modules\CodeUser\Models\User::where('email', config('codeuser.user_default.email'))->first();
        $user->forceDelete();

        Schema::enableForeignKeyConstraints();
    }
}
