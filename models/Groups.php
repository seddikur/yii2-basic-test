<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property string $title Название
 * @property string|null $description Описание
 * @property int $status Статус
 *
 * @property array $statusList
 *
 * @property GroupPassword[] $groupPasswords
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
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
            'title' => 'Название',
            'description' => 'Описание',
            'status' => 'Статус',
        ];
    }


    public function getStatusList()
    {
        return [
            Constants::STATUS_GROUP_ACTIVE => 'Активена',
            Constants::STATUS_GROUP_BLOCKED => 'Заблокирована',
        ];
    }

    /**
     * Возвращает статус групп
     */
    public function getStatusNameGroup()
    {
        switch ($this->status) {

            case Constants::STATUS_GROUP_ACTIVE:
                return '<span class="badge bg-success">' . $this->statusList[Constants::STATUS_GROUP_ACTIVE] . '</span>';
                break;
            case Constants::STATUS_GROUP_BLOCKED:
                return '<span class="badge bg-danger">' . $this->statusList[Constants::STATUS_GROUP_BLOCKED] . '</span>';
                break;
        }
        return false;
    }

    /**
     * Gets query for [[GroupPasswords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupPasswords()
    {
        return $this->hasMany(GroupPassword::class, ['group_id' => 'id']);
    }
}
