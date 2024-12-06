<?php
/**
 * Created by PhpStorm.
 * User: Баранов Владимир <phpnt@yandex.ru>
 * Date: 18.08.2018
 * Time: 19:29
 */

namespace app\models\extend;

use app\models\Constants;
use app\models\GroupUser;
use app\models\Users;
use Yii;
use yii\base\NotSupportedException;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\IdentityInterface;

/**
 * Класс пользователей
 * @property array $sexList
 * @property array $statusList
 * @property string $statusName
 * // * @property array $userRoles
 * @property array $roleName
 * @property array $userRole
 *
 * // * @property AuthAssignmentForm[] $authAssignments
 * // * @property AuthItemForm[] $itemNames
 * // * @property UserOauthKeyForm[] $keys
 * // * @property DocumentForm $document
 */
class UserExtend extends Users implements IdentityInterface
{
//    public $id;
//    public $username;
//    public $auth_key;
//    public $password_hash;
//    public $password_reset_token;
//    public $email;
//    public $last_name;
//    public $first_name;
//    public $patronymic;
//    public $avatar;
//    public $verification_token;
//    public $status;
//    public $created_at;
//    public $updated_at;
//    public $role;
//    public $ip;

    /** @param Users */
    private $_newsModel;

    /** @var string путь до папки с аватарками */
    public const PATH_AVATAR_IMAGE = '@backend/web/uploads/employee/avatars/';
    /** @var string путь до папки с аватарками */
    public const PATH_AVATAR_IMAGE_THUMBS = '@backend/web/uploads/employee/avatars/thumbs/';
    /** @var string URL на папку с аватарками */
    public const URL_AVATAR_IMAGE = '/uploads/employee/avatars/';
    /** @var string URL на папку с миниатюрами аватарок */
    public const URL_AVATAR_IMAGE_THUMBS = '/uploads/employee/avatars/thumbs/';
    /** @var string URL до аватара-заглушки */
    public const URL_AVATAR_NO_IMAGE = '/images/nouser.png';

    /**
     * UsersService constructor.
     * @param array $config
     */
//    public function __construct($config = []) {
//
//        parent::__construct($config);
//
//        if(isset($config['id']) && $config['id']) {
//            $this->_newsModel = Users::findOne($config['id']);
//            $this->setAttributes($this->_newsModel->getAttributes());
//        }
//        else {
//            $this->_newsModel = new Users();
//            $this->attributes = $this->_newsModel->attributes;
//        }
//    }

//    public function rules()
//    {
//        return $this->_newsModel->rules();
//    }
//
//    public function attributeLabels()
//    {
//        return $this->_newsModel->attributeLabels();
//    }


//    public function getSexList()
//    {
//        return [
//            Constants::SEX_FEMALE => Yii::t('app', 'Женский'),
//            Constants::SEX_MALE => Yii::t('app', 'Мужской'),
//        ];
//    }

//    public function getUserRole()
//    {
//        $modelAuthAssignmentForm = AuthAssignmentForm::findOne(['user_id' => $this->id]);
//
//        return $modelAuthAssignmentForm->itemName->description;
//    }

//    public function getUserRoles()
//    {
//        $data = (new \yii\db\Query())
//            ->select(['*'])
//            ->from('auth_item')
//            ->where(['type' => Constants::TYPE_ROLE])
//            ->all();
//
//        return ArrayHelper::map($data, 'name', 'description');
//    }

    /**
     * Роль
     *Yii::$app->user->identity->getRoleName()
     * @param string $username
     * @return static|null
     */
    public function getRoleName()
    {
//        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        $roles = Yii::$app->authManager->getAssignments($this->id);
        if (!$roles) {
            return null;
        }

        reset($roles);
        /* @var $role \yii\rbac\Role */
        $role = current($roles);

//        return $role->name;
        return $role->roleName;
    }

    /**
     * @return string[]
     */
    public static function getStatusesArray()
    {
        return [
            Constants::STATUS_WAIT => Yii::t('app', 'Не подтвержден'),
            Constants::STATUS_ACTIVE => Yii::t('app', 'Активен'),
            Constants::STATUS_BLOCKED => Yii::t('app', 'Заблокирован'),
        ];
    }

    public function getStatusList()
    {
        return [
            Constants::STATUS_WAIT => Yii::t('app', 'Не подтвержден'),
            Constants::STATUS_ACTIVE => Yii::t('app', 'Активен'),
            Constants::STATUS_BLOCKED => Yii::t('app', 'Заблокирован'),
        ];
    }

    /**
     * Возвращает статус пользователя
     */
    public function getStatusName()
    {
        switch ($this->status) {
            case Constants::STATUS_WAIT:
                return '<span class="badge bg-warning">' . $this->statusList[Constants::STATUS_WAIT] . '</span>';
                break;
            case Constants::STATUS_ACTIVE:
                return '<span class="badge bg-success">' . $this->statusList[Constants::STATUS_ACTIVE] . '</span>';
                break;
            case Constants::STATUS_BLOCKED:
                return '<span class="badge bg-danger">' . $this->statusList[Constants::STATUS_BLOCKED] . '</span>';
                break;
        }
        return false;
    }

    /**
     * Статусы пользователя
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            Constants::STATUS_BLOCKED => Yii::t('app', 'Заблокирован'),
            Constants::STATUS_ACTIVE => Yii::t('app', 'Активен'),
            Constants::STATUS_WAIT => Yii::t('app', 'Не активен'),
        ];
    }

    /**
     * Название групп
     * @return string
     */
    public function getGroupName()
    {
        $group = GroupUser::findOne(['user_id' => $this->id]);
        if (!empty($group->group)) {
            return '<span class="badge text-bg-secondary">' . $group->group->title . '</span>';
        } else {
            return '';
        }
    }

    /**
     * Id групп пользователя
     * @return string
     */
    public function getGroupId()
    {
        $group = GroupUser::findOne(['user_id' => $this->id]);
        if (!empty($group->group)) {
            return $group->group->id ;
        } else {
            return null;
        }
    }

    /**
     * Гендерный список
     * @return array
     */
//    public static function getSexArray()
//    {
//        return [
//            Constants::SEX_MALE =>  Yii::t('app', 'Мужской'),
//            Constants::SEX_FEMALE => Yii::t('app', 'Женский'),
//        ];
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(DocumentForm::className(), ['id' => 'document_id']);
    }

    /**
     * Связи пользователь => роль
     * @return \yii\db\ActiveQuery
     */
//    public function getAuthAssignments()
//    {
//        return $this->hasMany(AuthAssignmentForm::className(), ['user_id' => 'id']);
//    }

    /**
     * Роли и допуски (разрешения)
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItemForm::className(), ['name' => 'item_name'])->viaTable('lb_auth_assignment', ['user_id' => 'id']);
    }

    /**
     * Ключи авторизации соц. сетей и страницы соц. сетей
     * @return \yii\db\ActiveQuery
     */
    public function getKeys()
    {
        return $this->hasMany(UserOauthKeyForm::className(), ['user_id' => 'id']);
    }

    /**
     * Страна
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(GeoCountryForm::className(), ['id' => 'country_id']);
    }


    /**
     * Город
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(GeoCityForm::className(), ['id' => 'city_id']);
    }

    /*****************************************************************************************************************
     *                                                                                                  GET PROPERTIES
     *****************************************************************************************************************/

    /**
     * Поиск пользователя по Id
     * @param int|string $id - ID
     * @return null|static
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Поиск пользователя по Email
     * @param $email - электронная почта
     * @return null|static
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Ключ авторизации
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * ID пользователя
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Проверка ключа авторизации
     * @param string $authKey - ключ авторизации
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Поиск по токену доступа (не поддерживается)
     * @param mixed $token - токен
     * @param null $type - тип
     * @throws NotSupportedException - Исключение "Не подерживается"
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException(Yii::t('app', 'Поиск по токену не поддерживается.'));
    }

    /**
     * Проверка правильности пароля
     * @param $password - пароль
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Генераия Хеша пароля
     * @param $password - пароль
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Поиск по токену восстановления паролья
     * Работает и для неактивированных пользователей
     * @param $token - токен восстановления пароля
     * @return null|static
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * Генерация случайного авторизационного ключа
     * для пользователя
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Проверка токена восстановления пароля
     * согласно его давности, заданной константой EXPIRE
     * @param $token - токен восстановления пароля
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $parts = explode('_', $token);
        $timestamp = (int)end($parts);
        return $timestamp + Yii::$app->params['user.passwordResetTokenExpire'] >= time();
    }

    /**
     * Генерация случайного токена
     * восстановления пароля
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Очищение токена восстановления пароля
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Проверка токена подтверждения Email
     * @param $email_confirm_token - токен подтверждения электронной почты
     * @return null|static
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => Constants::STATUS_WAIT]);
    }

    /**
     * Генерация случайного токена
     * подтверждения электронной почты
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Очищение токена подтверждения почты
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * Сохраняем изображения после сохранения
     * данных пользователя
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

    }

    /**
     * Действия, выполняющиеся после авторизации.
     * Сохранение IP адреса и даты авторизации.
     *
     * Для активации текущего обновления необходимо
     * повесить текущую функцию на событие 'on afterLogin'
     * компонента user в конфигурационном файле.
     * @param $id - ID пользователя
     */
    public static function afterLogin($id)
    {
        self::getDb()->createCommand()->update(self::tableName(), [
            'ip' => $_SERVER["REMOTE_ADDR"],
//            'login_at' => date('Y-m-d H:i:s')
        ], ['id' => $id])->execute();
    }


    /**
     * Список всех пользователей
     * @param bool $show_id - показывать ID пользователя
     * @return array - [id => Имя Фамилия (ID)]
     */
    public static function getAll($show_id = false)
    {
        $users = [];
        $model = self::find()->all();
        if ($model) {
            foreach ($model as $m) {
                $name = ($m->last_name) ? $m->first_name . " " . $m->last_name : $m->first_name;
                if ($show_id) {
                    $name .= " (" . $m->id . ")";
                }
                $users[$m->id] = $name;
            }
        }

        return $users;
    }
}