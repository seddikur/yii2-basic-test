<?php

use yii\db\Migration;

/**
 * Создается таблица "Сервис".
 */
class m241203_134038_create_table_service extends Migration
{
    /**
     * Наименование таблицы, которая создается
     */
    const TABLE_NAME = 'service';


    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Сервис"';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('Название'),
        ], $tableOptions);


        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $this->insert(
                self::TABLE_NAME,
                [
                    'title' => $faker->catchPhrase,
//                    'description' => $faker->text(rand(100, 200)),
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
