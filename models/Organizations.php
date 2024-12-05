<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "organizations".
 *
 * @property int $id
 * @property string $title Название
 * @property string|null $description Описание
 * @property int|null $created_at Создана
 * @property int|null $updated_at Изменена
 *
 * @property OrganizationUser[] $organizationUsers
 */
class Organizations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organizations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название организации',
            'description' => 'Описание',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
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
//        return [[
//            'class' => TimestampBehavior::className(),
//            'createdAtAttribute' => 'created_at',
//            'updatedAtAttribute' => 'updated_at',
//            'value' => time(),
//        ]];
    }

    /**
     * Gets query for [[OrganizationUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationUsers()
    {
        return $this->hasMany(OrganizationUser::class, ['organization_id' => 'id']);
    }
}
