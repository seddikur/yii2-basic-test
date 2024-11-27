<?php

namespace app\modules\profile\services;

use app\models\Users;


class UserAvatarImageService 
{
    /** @var string URL на папку с аватарками */
    public const URL_AVATAR_IMAGE = '/uploads/employee/avatars/';
    /** @var string URL до аватара-заглушки */
    public const URL_AVATAR_NO_IMAGE = '/images/nouser.png';

    /**
     * Возвращает URL-адрес изображения аватара сотрудника
     * @param Users $users
     * @return string
     */
    public function getEmployeeImageUrl(Users $users): string
    {
        if ($fileName = $users->avatar) {
            $basePath = $this::URL_AVATAR_IMAGE;
            return $basePath . $fileName;
        }
        return '';
    }

    /**
     * Возвращает URL-адрес фиктивного изображения аватара
     * @return string
     */
    public function getDefaultImageUrl(): string
    {
        return $this::URL_AVATAR_NO_IMAGE;
    }
}
