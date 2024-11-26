<?php

namespace app\modules\profile\models;

use app\models\extend\UserExtend;
use app\modules\profile\services\UserAvatarImageService;
use app\models\Users;
use backend\modules\settings\modules\organization\models\EmployeeContacts;
use yii\base\Model;
use yii\helpers\VarDumper;

class UserProfileViewModel extends Model
{
    /** @var UserAvatarImageService */
    private $avatarService;
    /** @var int */
    private $viewerId;
    /** @var Users */
    private $users;

    /**
     * UserProfileModel constructor.
     * @param int                    $viewerId
     * @param Users                  $targetUsers
     * @param UserAvatarImageService $avatarService
     * @param array                  $config
     */
    public function __construct(
        int $viewerId,
        Users $targetUsers,
        UserAvatarImageService $avatarService,
        array $config = []
    )
    {
        parent::__construct($config);
        $this->avatarService = $avatarService;
        $this->viewerId = $viewerId;
        $this->users = $targetUsers;
    }

    /**
     * Просматривает ли текущий пользователь свой собственный профиль
     * @return bool
     */
    public function isCurrentUserProfile(): bool
    {
        return $this->viewerId === $this->users->id;
    }

    /**
     * @return Users
     */
    public function getUsers(): Users
    {
        return $this->users;
    }

    /**
     * Пытается создать и вернуть относительный путь к файлу изображения аватара сотрудника.
     * Если у сотрудника нет загруженного изображения аватара или файл не существует, будет возвращен путь к фиктивному изображению
     * @return string
     */
    public function getAvatarImageUrl(): string
    {
        if ($url = $this->avatarService->getEmployeeImageUrl($this->users)) {
            return $url;
        }
        return $this->avatarService->getDefaultImageUrl();
    }

    /**
     * Возвращает заголовок страницы в зависимости от типа просматриваемого профиля
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->isCurrentUserProfile() ? 'Моя страница' : $this->users->fullName;
    }

    /**
     * Профессия  !!! не сделана
     * @return string
     */
    public function getEmployeePositionTitle(): string
    {
        $titleParts = [];
        if ($profession = $this->users->profession) {
            $titleParts[] = $profession->profession_title;
        }

        return implode(', ', $titleParts);
    }

    /**
     * Возвращает список контактов сотрудников
     * @return UserProfileValueInterface[]
     */
    public function getUsersContacts(): array
    {
        [];
//        return array_map(function (EmployeeContacts $contact) {
//            return new UserProfileContactValueModel($contact);
//        }, $this->employee->contacts);
    }

    /**
     * возвращает список значений персональных данных сотрудников
     * @return UserProfileValueInterface[]
     */
    public function getUserPersonalInformation(): array
    {
        $stack = [];

//        if ($subs = array_values($this->users->subdivision)) {
//            $stack[] = new UserProfilePlainValueModel(
//                'Подразделения',
//                implode(', ', array_column($subs, 'subdivision_title'))
//            );
//        }

//        if ($birthDate = $this->users->passport_birth_date) {
//            $stack[] = new UserProfilePlainValueModel(
//                'Дата рождения',
//                $birthDate
//            );
//        }
        if ($birthDate = $this->users->created_at) {
            $stack[] = new UserProfilePlainValueModel(
                'Создана запись',
                $birthDate
            );
        }

        return $stack;
    }
}
