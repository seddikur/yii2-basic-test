<?php

use yii\db\Migration;

/**
 * Создается таблица "Пользователи".
 */
class m241022_065421_create_table_users extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'users';


    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Пользователи"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('Логин'),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique()->comment('E-mail'),
            'last_name' => $this->string()->comment('Фамилия'),
            'first_name' => $this->string()->comment('Имя'),
            'patronymic' => $this->string()->comment('Отчество'),
            'verification_token' => $this->string()->defaultValue(null),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('Статус'),
            'created_at' => $this->integer()->notNull()->comment('Создан'),
            'updated_at' => $this->integer()->notNull()->comment('Изменен'),

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
