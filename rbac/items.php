<?php
/**
 * Yii::$app->authManager->getRole('admin'),
 */
return [
    'permAdminPanel' => [
        'type' => 2,
        'description' => 'Админ панель',
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователи',
    ],
//    'moder' => [
//        'type' => 1,
//        'description' => 'Модераторы',
//    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администраторы',
        'children' => [
            'user',
            'admin',
            'permAdminPanel',
        ],
    ],
];
