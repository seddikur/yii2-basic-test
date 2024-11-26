<?php

namespace app\modules\profile\services;

use app\models\Users;
/**
 * Class UserPermissionService
 */
class UserPermissionService
{
    /**
     * @param int      $usersId
     * @param Users $users
     * @return bool
     */
    public function isEmployeeCanEditEmployeeContacts(int $usersId, Users $users): bool
    {
        // Employee allowed to edit only he's own contacts
        return $usersId === $users->id;
    }

    /**
     * @param int      $usersId
     * @param Users $users
     * @return bool
     */
    public function isEmployeeCanEditEmployee(int $usersId, Users $users): bool
    {
        // Employee allowed to edit only he's own profile
        return $usersId === $users->id;
    }
}
