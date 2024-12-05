<?php

use yii\db\Migration;
use app\models\Passwords;

/**
 * Class m241205_121357_add_users_service_field
 */
class m241205_121357_add_password_service_field extends Migration
{

    /**
     * Поля, которые имеют внешние ключи
     */
    const FIELD_SERVICE_ID_NAME = 'service_id';

    /** @var string наименование внешнего ключа для добавляемого поля service_id */
    private $fkServiceIdName;
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->fkServiceIdName = 'fk_' . Passwords::tableName(). '_' . self::FIELD_SERVICE_ID_NAME;
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn(Passwords::tableName(),  self::FIELD_SERVICE_ID_NAME, $this->integer()->comment('Сервис'));

        $this->createIndex(self::FIELD_SERVICE_ID_NAME, Passwords::tableName(), self::FIELD_SERVICE_ID_NAME);
        $this->addForeignKey($this->fkServiceIdName, Passwords::tableName(), self::FIELD_SERVICE_ID_NAME, 'service', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fkServiceIdName, Passwords::tableName());
        $this->dropIndex(self::FIELD_SERVICE_ID_NAME,Passwords::tableName());
        $this->dropColumn(Passwords::tableName(), self::FIELD_SERVICE_ID_NAME);
    }
}
