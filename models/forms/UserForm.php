<?php
/**
 * Created by PhpStorm.
 * User: Баранов Владимир <phpnt@yandex.ru>
 * Date: 18.08.2018
 * Time: 19:29
 */

namespace app\models\forms;

use app\models\Constants;
use Yii;
use app\models\extend\UserExtend;
use yii\behaviors\TimestampBehavior;

class UserForm extends UserExtend
{

    public $password;
    public $password_confirm;

    /** @var string Группа */
    public $group_id;

//    public $role;
    public $permission;

    public function rules()
    {
        $items = UserExtend::rules();
        $items[] = [['email', 'group_id', 'username'], 'required'];
        $items[] = [['password', 'password_confirm'], 'required', 'on' => 'create-user'];
        $items[] = [['password', 'password_confirm'], 'string'];
        $items[] = ['password_confirm', 'compare', 'compareAttribute' => 'password'];

        return $items;
    }

    public function attributeLabels()
    {
        $items = UserExtend::attributeLabels();
        $items['username'] ='Логин';
        $items['password'] = 'Пароль';
        $items['password_confirm'] =  'Подтверждение пароля';
        $items['group_id'] =  'Группа пользователей';

        return $items;
    }

    /**
     * Автозаполнение полей создание и редактирование
     * профиля
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
//        return [[
//            'class' => TimestampBehavior::className(),
//            'createdAtAttribute' => 'created_at',
//            'updatedAtAttribute' => 'updated_at',
//            'value' => time(),
//        ]];
    }


    /**
     * @return bool
     */
    public function beforeValidate()
    {
        parent::beforeValidate();

        if ($this->password) {
            $this->setPassword($this->password);
        }
        if ($this->scenario == 'create-user') {
            $this->auth_key = Yii::$app->security->generateRandomString();
        }

        return true;
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
                $this->generatePasswordResetToken();
//                $this->generateEmailVerificationToken();
            }
            return true;
        }
        return false;
    }
    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        /* Назначение роли */
//        if ($this->role) {
//            AuthAssignmentForm::deleteAll(['user_id' => $this->id]);
//            $auth = Yii::$app->authManager;
//            $role = $auth->getRole($this->role);
//            $auth->assign($role, $this->id);
//        }
    }

    public function afterFind()
    {
        parent::afterFind();

//        foreach ($this->authAssignments as $authAssignment) {
//            $this->role = $authAssignment->item_name;
//        }
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => Constants::STATUS_ACTIVE]);
    }
}