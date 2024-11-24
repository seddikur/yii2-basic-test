<?php

namespace app\modules\user;

use yii\filters\AccessControl;

/**
 * user module definition class
 */
class User extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
//        $this->layout = '/user/main';
        parent::init();

        // custom initialization code goes here
    }

    /**
     * Блокируем доступ ко всему модулю
     * для всех пользователей не прошедших аутентификацию
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}
