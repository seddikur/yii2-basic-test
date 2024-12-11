<?php

namespace app\models;

use app\modules\user\User;
use Yii;
use yii\helpers\VarDumper;

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
    /** @var array Виртуально поле пользователи */
    public $array_user_id;

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
            [['array_user_id'], 'safe'],
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

            //доп поле
            'array_user_id' => 'Пользователи',
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
     * Название групп
     * @return string
     */
    public function getGroupName()
    {
        $groups = GroupUser::find()->asArray()->where(['group_id' => $this->id])->all();

        $name = '';
        foreach ($groups as $group_id) {
            $name_user = Users::findOne(['id' => $group_id['user_id']]);
            $name .= '<span class="badge text-bg-secondary">' . $name_user->username . '</span>' . ' ';
        }
        return $name;
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
