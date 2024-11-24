<?php

use yii\db\Migration;

/**
 * Создается таблица "Организации".
 */
class m241124_141539_create_table_organizations extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'organizations';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Организации"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('Название'),
            'description' => $this->string()->comment('Описание'),
            'created_at' => $this->integer()->comment('Создана'),
            'updated_at' => $this->integer()->comment('Изменена'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

}
