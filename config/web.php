<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
require __DIR__ . '/functions.php';

$config = [
    'id' => 'basic',
    'name'=>'Название',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'ru',
    'sourceLanguage'=>'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    // перевести сайт в режим обслуживания
//    'catchAll' => ['site/offline'],
    'modules' => [
        'admin' => ['class' => \app\modules\admin\Admin::class],
        'user' => ['class' => \app\modules\user\User::class],
        'profile' => ['class' => \app\modules\profile\Module::class],
        'gridview' => ['class' => 'kartik\grid\Module']
    ],
    'components' => [
        'authManager' => [
//            'class' => 'yii\rbac\PhpManager',
            'class' => 'app\components\AuthManager',
            'defaultRoles' => ['admin', 'user', 'moder'],
            //зададим куда будут сохраняться наши файлы конфигураций RBAC/ это и по умолчанию
            'itemFile' => '@app/rbac/items.php',
            'assignmentFile' => '@app/rbac/assignments.php',
            'ruleFile' => '@app/rbac/rules.php'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kpyt4SuVlYmu5P4SOwNRTlQOvdtPgfGV',
            'baseUrl'=> ''
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => \app\models\forms\UserForm::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],


    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
//        'allowedIPs' => ['*'],
//        'allowedIPs' => ['127.0.0.1', '::1'],
//        'allowedIPs' => ['127.0.0.1', '192.168.*', '::1', '172.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
