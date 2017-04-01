<?php

use Illuminate\Database\Migrations\Migration;
use Modules\CodeUser\Models\Permission;

class CreateManageBookPermissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        list($name, $resourceName) = explode('/', config('codebook.acl.permissions.book_manage_all'));

        Permission::create([
            'name' => $name,
            'description' => 'Administração de livros',
            'resource_name' => $resourceName,
            'resource_description' => 'Gerenciar todos os livros',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        list($name, $resourceName) = explode('/', config('codebook.acl.permissions.book_manage_all'));

        $permission = Permission::where('name', $name)->where('resource_name', $resourceName)->first();
        $permission->roles()->detach();
        $permission->delete();
    }
}
