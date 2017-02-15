<?php

return [
    'name' => 'CodeUser',

    'user_default' => [
        'name' => env('USER_NAME', 'Admin'),
        'email' => env('USER_EMAIL', 'admin@codepub.com'),
        'password' => env('USER_PASSWORD', 'secret'),
    ],

    'acl' => [
        'role_admin' => env('ROLE_ADMIN', 'Admin'),
        'controllers_annotations' => [
            base_path('modules/CodeUser/Http/Controllers'),
        ],
    ],
];
