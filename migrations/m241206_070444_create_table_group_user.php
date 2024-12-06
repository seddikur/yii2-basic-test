<?php

use yii\db\Migration;

/**
 * Создается таблица "Группы-пользователи".
 */
class m241206_070444_create_table_group_user extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'group_user';
    /**
     * Поля, которые имеют внешние ключи
     */
    const FIELD_USER_ID_NAME = 'user_id';
    const FIELD_GROUP_ID_NAME = 'group_id';

    /** @var string наименование внешнего ключа для добавляемого поля user_id */
    private $fkUserIdName;

    /** @var string наименование внешнего ключа для добавляемого поля group_id */
    private $fkGroupIdName;

    public function init()
    {
        $this->fkUserIdName = 'fk_' . self::TABLE_NAME . '_' . self::FIELD_USER_ID_NAME;
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
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Группы-пользователи"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            self::FIELD_USER_ID_NAME => $this->integer()->notNull()->comment('Пользователь'),
            self::FIELD_GROUP_ID_NAME => $this->integer()->notNull()->comment('Группа'),
        ], $tableOptions);

        $this->createIndex(self::FIELD_USER_ID_NAME, self::TABLE_NAME, self::FIELD_USER_ID_NAME);
        $this->createIndex(self::FIELD_GROUP_ID_NAME, self::TABLE_NAME, self::FIELD_GROUP_ID_NAME);
        $this->addForeignKey($this->fkUserIdName, self::TABLE_NAME, self::FIELD_USER_ID_NAME, 'users', 'id');
        $this->addForeignKey($this->fkGroupIdName, self::TABLE_NAME, self::FIELD_GROUP_ID_NAME, 'groups', 'id');
    }


    /**
     * Удаление
     * @return false|mixed|void
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fkGroupIdName, self::TABLE_NAME);
        $this->dropForeignKey($this->fkUserIdName, self::TABLE_NAME);
        $this->dropIndex(self::FIELD_GROUP_ID_NAME,self::TABLE_NAME);
        $this->dropIndex(self::FIELD_USER_ID_NAME,self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }
}
