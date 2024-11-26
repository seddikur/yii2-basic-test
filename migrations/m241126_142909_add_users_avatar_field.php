<?php

use yii\db\Migration;
use app\models\Users;

/**
 * Class m241126_142909_add_users_avatar_field
 */
class m241126_142909_add_users_avatar_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Users::tableName(), 'avatar', $this->string(255)->comment('Аватарка'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Users::tableName(), 'avatar');
    }

}
