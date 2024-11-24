<?php

namespace app\models;

use Yii;

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
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
