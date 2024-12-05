<?php

use yii\db\Migration;

/**
 * Создается таблица "Группы-пароли".
 */
class m241205_081723_create_table_password_group extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'group_password';
    /**
     * Поля, которые имеют внешние ключи
     */
    const FIELD_PASSWORD_ID_NAME = 'password_id';
    const FIELD_GROUP_ID_NAME = 'group_id';

    /** @var string наименование внешнего ключа для добавляемого поля password_id */
    private $fkPasswordId;

    /** @var string наименование внешнего ключа для добавляемого поля group_id */
    private $fkGroupIdName;

    public function init()
    {
        $this->fkPasswordId = 'fk_' . self::TABLE_NAME . '_' . self::FIELD_PASSWORD_ID_NAME;
        $this->fkGroupIdName = 'fk_' . self::TABLE_NAME . '_' . self::FIELD_GROUP_ID_NAME;
    }

    /**
     * Создание
     * @return false|mixed|void
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Группы-пароли"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            self::FIELD_PASSWORD_ID_NAME => $this->integer()->notNull()->comment('Пароль'),
            self::FIELD_GROUP_ID_NAME => $this->integer()->notNull()->comment('Группа'),
        ], $tableOptions);

        $this->createIndex(self::FIELD_PASSWORD_ID_NAME, self::TABLE_NAME, self::FIELD_PASSWORD_ID_NAME);
        $this->createIndex(self::FIELD_GROUP_ID_NAME, self::TABLE_NAME, self::FIELD_GROUP_ID_NAME);
        $this->addForeignKey($this->fkPasswordId, self::TABLE_NAME, self::FIELD_PASSWORD_ID_NAME, 'passwords', 'id');
        $this->addForeignKey($this->fkGroupIdName, self::TABLE_NAME, self::FIELD_GROUP_ID_NAME, 'groups', 'id');
    }


    /**
     * Удаление
     * @return false|mixed|void
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fkGroupIdName, self::TABLE_NAME);
        $this->dropForeignKey($this->fkPasswordId, self::TABLE_NAME);
        $this->dropIndex(self::FIELD_GROUP_ID_NAME,self::TABLE_NAME);
        $this->dropIndex(self::FIELD_PASSWORD_ID_NAME,self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }
}
