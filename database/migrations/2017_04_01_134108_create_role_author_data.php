<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAuthorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAuthor = \Modules\CodeUser\Models\Role::create([
            'name' => config('codebook.acl.role_author'),
            'description' => 'Autor de livros no sistema',
        ]);

        $user = \Modules\CodeUser\Models\User::where('email', config('codebook.author_default.email'))->first();
        $user->roles()->save($roleAuthor);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAuthor = \Modules\CodeUser\Models\Role::where('name', config('codebook.acl.role_author'))->first();
        $user = \Modules\CodeUser\Models\User::where('email', config('codebook.author_default.email'))->first();
        $user->roles()->detach($roleAuthor->id);

        $roleAuthor->delete();
    }
}
