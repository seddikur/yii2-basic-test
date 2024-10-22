<?php

use yii\db\Migration;

/**
 * Создается таблица "Проекты".
 */
class m241022_082101_create_table_projects extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'projects';

    /**
     * Поля, которые имеют внешние ключи
     */
    const FIELD_USER_ID_NAME = 'user_id';

    /** @var string наименование внешнего ключа для добавляемого поля user_id */
    private $fkUserIdName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->fkUserIdName = 'fk_' . self::TABLE_NAME . '_' . self::FIELD_USER_ID_NAME;
    }

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Проекты"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('Название'),
            'description' => $this->string()->comment('Описание'),
            'price' => $this->integer()->comment('Цена'),
            'created_at' => $this->integer()->comment('Дата создания'),
            'data_result' => $this->integer()->comment('Дата сдачи'),
            self::FIELD_USER_ID_NAME => $this->integer()->notNull()->comment('Пользователь'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('Статус'),

        ], $tableOptions);

        $this->createIndex(self::FIELD_USER_ID_NAME, self::TABLE_NAME, self::FIELD_USER_ID_NAME);
        $this->addForeignKey($this->fkUserIdName, self::TABLE_NAME, self::FIELD_USER_ID_NAME, 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fkUserIdName, self::TABLE_NAME);

        $this->dropIndex(self::FIELD_USER_ID_NAME,self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }

}
