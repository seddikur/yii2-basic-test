<?php
namespace app\models;

use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use app\models\Users;

/**
 * Создаем класс правил.
 * Сравнивается роль текущего пользователя с ролью, которая необходима для получения доступа
 */
class UserRoleRule extends Rule
{
    public $name = 'userRole'; //название данного правила
    /*
     * $user - id текущего пользователя
     * $item - объект роли которую проверяем у текущего пользователя
     * $params - параметры, которые можно передать для проведеня проверки в данный класс
     */
    public function execute($user, $item, $params)
    {
        //Получаем объект текущего пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', Users::findOne($user));

        if ($user) {
            $role = $user->role;

            if ($item->name === 'admin') {
                return $role == Constants::ROLE_ADMIN;
            }
            elseif ($item->name === 'moder') {
                return $role == Constants::ROLE_ADMIN || $role == Constants::ROLE_MODER;
            }
            elseif ($item->name === 'user') {
                return $role == Constants::ROLE_ADMIN || $role == Constants::ROLE_MODER
                    || $role == Constants::ROLE_USER;
            }
        }
        return false;
    }
}
