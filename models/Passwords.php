<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "passwords".
 *
 * @property int $id
 * @property string $sault Создан
 * @property string $password password
 * @property string $hash hash
 * @property int $user_id ID пользователя
 * @property int $organization_id ID организации
 * @property int|null $created_at Создан
 * @property int|null $updated_at Изменен
 * @property string|null $ip Ip
 *
 * @property Organizations $organization
 * @property Users $user
 */
class Passwords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'passwords';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sault', 'password', 'hash', 'user_id', 'organization_id'], 'required'],
            [['user_id', 'organization_id', 'created_at', 'updated_at'], 'integer'],
            [['sault', 'password', 'hash'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 64],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::class, 'targetAttribute' => ['organization_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sault' => 'Создан',
            'password' => 'password',
            'hash' => 'hash',
            'user_id' => 'ID пользователя',
            'organization_id' => 'ID организации',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'ip' => 'Ip',
        ];
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
    }
    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organizations::class, ['id' => 'organization_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
