<?php

use Illuminate\Database\Seeder;

class AuthorAclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAuthor = \Modules\CodeUser\Models\Role::where('name', config('codebook.acl.role_author'))->first();
        $permissionsBook = \Modules\CodeUser\Models\Permission::where('name', 'like', 'codebook%')->pluck('id')->all();
        $permissionsCategory = \Modules\CodeUser\Models\Permission::where('name', 'like', 'codebook%')->pluck('id')->all();

        $roleAuthor->permissions()->attach($permissionsBook);
        $roleAuthor->permissions()->attach($permissionsCategory);
    }
}
