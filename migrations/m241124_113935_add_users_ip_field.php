<?php

use yii\db\Migration;
use app\models\Users;
/**
 * Class m241124_113935_add_users_ip_field
 */
class m241124_113935_add_users_ip_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Users::tableName(), 'ip', $this->string(64)->comment('Ip'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Users::tableName(), 'ip');
    }
}
