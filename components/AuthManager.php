<?php

namespace app\components;

use app\models\Users;
use yii\rbac\Assignment;
use yii\rbac\PhpManager;
use Yii;

/**
 * Клас для настройки ролей
 * из файла
 *
 * //Yii::$app->authManager->assign($userRole, $userId);
 * Yii::$app->authManager->getRole('admin'),
 */
class AuthManager extends PhpManager
{

    /**
     * @param $userId
     * @return array|Assignment[]
     */
    public function getAssignments($userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            $assignment = new Assignment();
            $assignment->userId = $userId;
            $assignment->roleName = $user->role;
            return [$assignment->roleName => $assignment];
        }
        return [];
    }

    /**
     * @param $roleName
     * @param $userId
     * @return Assignment|null
     */
    public function getAssignment($roleName, $userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            if ($user->role == $roleName) {
                $assignment = new Assignment();
                $assignment->userId = $userId;
                $assignment->roleName = $user->role;
                return $assignment;
            }
        }
        return null;
    }

    /**
     * @param $roleName
     * @return array
     */
    public function getUserIdsByRole($roleName)
    {
        return Users::find()->where(['role' => $roleName])->select('id')->column();
    }

    public function assign($role, $userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            $assignment = new Assignment([
                'userId' => $userId,
                'roleName' => $role->name,
                'createdAt' => time(),
            ]);
            $this->setRole($user, $role->name);
            return $assignment;
        }
        return null;
    }

    public function revoke($role, $userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            if ($user->role == $role->name) {
                $this->setRole($user, null);
                return true;
            }
        }
        return false;
    }

    public function revokeAll($userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            $this->setRole($user, null);
            return true;
        }
        return false;
    }

    /**
     * @param integer $userId
     * @return null|\yii\web\IdentityInterface|Users
     */
    private function getUser($userId)
    {
        $webUser = Yii::$app->get('user', false);
        if ($webUser && !$webUser->getIsGuest() && $webUser->getId() == $userId) {
            return $webUser->getIdentity();
        } else {
            return Users::findOne($userId);
        }
    }

    /**
     * @param Users $user
     * @param string $roleName
     */
    private function setRole(Users $user, $roleName)
    {
        $user->role = $roleName;
        $user->updateAttributes(['role' => $roleName]);
    }
}