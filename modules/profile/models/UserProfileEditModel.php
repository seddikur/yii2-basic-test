<?php
//declare(strict_types=1);

namespace app\modules\profile\models;

use app\components\Avatar;
use app\models\Users;
use app\modules\profile\services\UserAvatarImageService;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * @author Kovalev Roman <epoxxid@gmail.com>
 */
class UserProfileEditModel extends Model
{
    /** @var UploadedFile */
    public $avatarImage;

    /** @var Users */
    private $users;
    /** @var UserAvatarImageService */
    private $imageService;

    /**
     * @param Users               $users
     * @param UserAvatarImageService $fileService
     * @param array                  $config
     */
    public function __construct(
        Users $users,
        UserAvatarImageService $fileService,
        array $config = []
    )
    {
        parent::__construct($config);
        $this->users = $users;
        $this->imageService = $fileService;
    }

    /**
     * @return Users
     */
    public function getUsers(): Users
    {
        return $this->users;
    }

    /**
     * Returns an URL to the employee image or empty string if not set
     * @return string
     */
    public function getAvatarImageUrl(): string
    {
        return $this->imageService->getEmployeeImageUrl($this->users);
    }

    /**
     * @param array $data
     * @param null  $formName
     * @return bool
     */
    public function load($data, $formName = null): bool
    {
        return $this->users->load($data);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['file', 'file'],
        ];
    }

    /**
     * Attempt to save profile
     * @return bool
     */
    public function save(): bool
    {
        $avatar = new Avatar(Users::isPathAvatar(), $this->users);
        $avatar->save();
        return $this->users->save();
    }
}
