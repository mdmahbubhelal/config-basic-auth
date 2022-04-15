<?php

return [
    'enabled' => env('BASICAUTH_ENABLED', true),
    'users' => [
        [
            'username' => 'user0',
            'password' => 'password0',
        ],
        [
            'username' => 'user1',
            'password' => 'password1',
        ]
    ],
];
