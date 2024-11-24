<?php

return [
    'permAdminPanel' => [
        'type' => 2,
        'description' => 'Админ панель',
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'children' => [
            'user',
            'admin',
            'permAdminPanel',
        ],
    ],
];
