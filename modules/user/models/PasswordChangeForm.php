<?php
namespace app\modules\user\models;

use  app\models\Users;
use app\modules\user\User;
use yii\base\Model;

/**
 * Password reset form
 */
class PasswordChangeForm extends Model
{
    public $currentPassword;
    public $newPassword;
    public $newPasswordRepeat;

    /**
     * @var Users
     */
    private $_user;

    /**
     * @param Users $user
     * @param array $config
     */
    public function __construct(Users $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['currentPassword', 'validatePassword'],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'newPassword' =>  'Новый пароль',
            'newPasswordRepeat' =>  'Повтор пароля',
            'currentPassword' =>  'Текуший пароль',
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
//            if (!$this->_user->validatePassword($this->$attribute)) {
//                $this->addError($attribute,  'ERROR_WRONG_CURRENT_PASSWORD');
//            }
        }
    }

    /**
     * @return boolean
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->setPassword($this->newPassword);
            return $user->save();
        } else {
            return false;
        }
    }
}