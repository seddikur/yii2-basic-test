<?php

use yii\db\Migration;
/**
 * Создается таблица "Пароли".
 */
class m241127_115533_create_table_password extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'passwords';

    /**
     * Поля, которые имеют внешние ключи
     */
    const FIELD_ORGANIZATION_ID_NAME = 'organization_id';


    /** @var string наименование внешнего ключа для добавляемого поля organization_id */
    private $fkOrganizationIdName;
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->fkOrganizationIdName = 'fk_' . self::TABLE_NAME . '_' . self::FIELD_ORGANIZATION_ID_NAME;
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Пароли"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'sault' => $this->string()->notNull()->comment('Создан'),
            'password' => $this->string()->notNull()->comment('password'),
            'hash' => $this->string()->notNull()->comment('hash'),
            self::FIELD_ORGANIZATION_ID_NAME => $this->integer()->notNull()->comment('ID организации'),
            'created_at' => $this->integer()->comment('Создан'),
            'updated_at' => $this->integer()->comment('Изменен'),
            'ip' => $this->string(64)->comment('Ip')
        ], $tableOptions);

        $this->createIndex(self::FIELD_ORGANIZATION_ID_NAME, self::TABLE_NAME, self::FIELD_ORGANIZATION_ID_NAME);
        $this->addForeignKey($this->fkOrganizationIdName, self::TABLE_NAME, self::FIELD_ORGANIZATION_ID_NAME, 'organizations', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fkOrganizationIdName, self::TABLE_NAME);

        $this->dropIndex(self::FIELD_ORGANIZATION_ID_NAME,self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }


}
