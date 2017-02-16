<?php

use Illuminate\Database\Migrations\Migration;

class CreateBooksAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Modules\CodeUser\Models\Role::create([
            'name' => 'Autor',
            'description' => 'Papel de autor dos livros',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAuthor = \Modules\CodeUser\Models\Role::where('name', 'Autor')->first();
        $roleAuthor->delete();
    }
}
