<?php

namespace app\modules\profile\helpers;

class UserProfileUrlHelper
{
    /**
     * Возвращает URL-адрес страницы просмотра профиля пользователя
     * @param $id
     * @return array
     */
    public function getViewProfileUrl($id): array
    {
        return ['/profile/view', 'id' => $id];
    }

    /**
     * Возвращает URL-адрес страницы редактирования профиля пользователя
     * @param $id
     * @return array
     */
    public function getEditProfileUrl($id)
    {
        return ['/profile/edit', 'id' => $id];
    }
}