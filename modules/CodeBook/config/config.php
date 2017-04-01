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
    ],
];
