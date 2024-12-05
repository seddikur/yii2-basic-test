<?php

use yii\db\Migration;

/**
 * Создается таблица "Группы пользователей".
 */
class m241205_081052_create_table_user_group extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'groups';


    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Группы пользователей"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('Название'),
            'description' => $this->string()->comment('Описание'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('Статус'),
        ], $tableOptions);

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $this->insert(
                self::TABLE_NAME,
                [
                    'title' => $faker->title,
                    'description' => $faker->text(rand(100, 200)),
                    'status' => rand(1, 2),
                ]
            );
        }
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
