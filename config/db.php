<?php

return [

    'class' => yii\db\Connection::class,
    'dsn' => 'mysql:host=yii2_sql;dbname=yii',
    'username' => 'yii',
    'password' => 'yii',
    'charset' => 'utf8',

    'enableSchemaCache' => true,
    'enableQueryCache' => false,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',

];
