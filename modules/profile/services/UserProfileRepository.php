<?php

namespace app\modules\profile\services;

use app\models\Users;

/**
 * Class UserProfileRepository
 */
class UserProfileRepository
{
    /**
     * @param $employeeId
     * @return EmployeeContacts[]
     */
//    public function findContactsByUsersId($employeeId): array
//    {
//        $users = $this->findUsersById($employeeId);
//        return $users ? $users->contacts : [];
//    }

    /**
     * Returns employee by given ID
     * @param $employeeId
     * @return Users|null
     */
    public function findUsersById($employeeId): ?Users
    {
        return Users::findOne($employeeId);
    }

    /**
     * @param int $employeeId
     * @param int $contactId
     * @return EmployeeContacts|mixed|null
     */
//    public function findEmployeeContact(int $employeeId, int $contactId): ?EmployeeContacts
//    {
//        $contacts = $this->findContactsByEmployeeId($employeeId);
//        foreach ($contacts as $contact) {
//            if ((int)$contact->id === $contactId) {
//                return $contact;
//            }
//        }
//        return null;
//    }


}
