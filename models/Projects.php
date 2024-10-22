<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $title Название
 * @property string|null $description Описание
 * @property int|null $price Цена
 * @property int|null $created_at Дата создания
 * @property int|null $data_result Дата сдачи
 * @property int $user_id Пользователь
 * @property int $status Статус
 *
 * @property Users $user
 *
 * @property Users $nameUser
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'user_id'], 'required'],
            [['price', 'created_at', 'data_result', 'user_id', 'status'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
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
            'title' => 'Название',
            'description' => 'Описание',
            'price' => 'Цена',
            'created_at' => 'Дата создания',
            'data_result' => 'Дата сдачи',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
        ];
    }

    /*****************************************************************************************************************
     *                                                                                                       RELATIONS
     *****************************************************************************************************************/
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
    /*****************************************************************************************************************
     *                                                                                                  GET PROPERTIES
     *****************************************************************************************************************/

    /**
     * Получаем login пользователя
     * @return string
     */
    public function getNameUser()
    {
        if(!$this->user){
            return "";
        }
        return $this->user->username;
    }
}
