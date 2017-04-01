<?php

return [
    'name' => 'CodeBook',

    'author_default' => [
        'name' => env('AUTHOR_NAME', 'Author'),
        'email' => env('AUTHOR_EMAIL', 'author@codepub.com'),
        'password' => env('AUTHOR_PASSWORD', 'secret'),
    ],

    'acl' => [
        'role_author' => env('ROLE_AUTHOR', 'Author'),
        'permissions' => [
            'book_manage_all' => 'codebook-books/manage_all',
        ],
    ],
];
