<?php

namespace app\models;

use Yii;
use app\models\forms\UserForm;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username Логин
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email E-mail
 * @property string|null $last_name Фамилия
 * @property string|null $first_name Имя
 * @property string|null $patronymic Отчество
 * @property string|null $verification_token
 * @property int $status Статус
 * @property int $created_at Создан
 * @property int $updated_at Изменен
 * @property string|null $role Роль пользователя
 * @property string|null $ip Ip
 *
 * @property Projects[] $projects
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'last_name', 'first_name', 'patronymic', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['role', 'ip'], 'string', 'max' => 64],

            ['username', 'match', 'pattern' => '#^[\w_-]+$#is'],
            ['username', 'unique', 'targetClass' => UserForm::className(), 'message' => 'Это имя пользователя уже было занято.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['status', 'default', 'value' => Constants::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(UserForm::getStatusesArray())],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => UserForm::className(), 'message' => 'Этот адрес электронной почты уже был занят..'],
            ['email', 'string', 'max' => 255],

            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'E-mail',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'patronymic' => 'Отчество',
            'verification_token' => 'Verification Token',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'role' => 'Роль',
            'ip' => 'Ip',
        ];
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Projects::class, ['user_id' => 'id']);
    }
}
