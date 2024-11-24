<?php

use yii\db\Migration;
use app\models\Users;

/**
 * Class m241123_125706_add_users_role_field
 */
class m241123_125706_add_users_role_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Users::tableName(), 'role', $this->string(64)->comment('Роль пользователя'));
        $this->update(Users::tableName(), ['role' => 'admin']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Users::tableName(), 'role');
    }

}
