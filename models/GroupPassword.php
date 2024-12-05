<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_password".
 *
 * @property int $id
 * @property int $password_id Пароль
 * @property int $group_id Группа
 *
 * @property Groups $group
 * @property Passwords $password
 */
class GroupPassword extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_password';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password_id', 'group_id'], 'required'],
            [['password_id', 'group_id'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::class, 'targetAttribute' => ['group_id' => 'id']],
            [['password_id'], 'exist', 'skipOnError' => true, 'targetClass' => Passwords::class, 'targetAttribute' => ['password_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password_id' => 'Пароль',
            'group_id' => 'Группа',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Password]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPassword()
    {
        return $this->hasOne(Passwords::class, ['id' => 'password_id']);
    }
}
