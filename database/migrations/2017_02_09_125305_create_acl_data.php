<?php

use Illuminate\Database\Migrations\Migration;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = \Modules\CodeUser\Models\Role::create([
            'name' => config('codeuser.acl.role_admin'),
            'description' => 'Papel de usuário mestre do sistema',
        ]);

        $user = \Modules\CodeUser\Models\User::where('email', config('codeuser.user_default.email'))->first();
        $user->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAdmin = \Modules\CodeUser\Models\Role::where('name', config('codeuser.acl.role_admin'))->first();
        $user = \Modules\CodeUser\Models\User::where('email', config('codeuser.user_default.email'))->first();
        $user->roles()->detach($roleAdmin->id);

        $roleAdmin->delete();
    }
}
