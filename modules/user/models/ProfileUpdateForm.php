<?php

namespace app\modules\user\models;

use app\models\Users;
use app\modules\user\User;
use yii\base\Model;
use yii\db\ActiveQuery;

class ProfileUpdateForm extends Model
{
    public $email;

    /**
     * @var Users
     */
    private $_user;

    /**
     * @param Users $user
     * @param array $config
     */
    public function __construct(Users $user, $config = [])
    {
        $this->_user = $user;
        $this->email = $user->email;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => Users::className(),
                'message' => 'ERROR_EMAIL_EXISTS',
                'filter' => function (ActiveQuery $query) {
                    $query->andWhere(['<>', 'id', $this->_user->id]);
                },
            ],
            ['email', 'string', 'max' => 255],
        ];
    }

    /**
     * @return bool
     */
    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->email = $this->email;
            return $user->save();
        } else {
            return false;
        }
    }
}