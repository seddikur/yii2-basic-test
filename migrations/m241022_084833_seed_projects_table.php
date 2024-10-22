<?php

use yii\db\Migration;

/**
 * Данные для таблицы Projects
 */
class m241022_084833_seed_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        {
            $faker = \Faker\Factory::create();
            $dateTime = (new DateTime())->getTimestamp();
            for ($i = 0; $i < 50; $i++) {
                $this->insert(
                    'projects',
                    [
                        'title' => $faker->catchPhrase,
                        'description' => $faker->text(rand(100, 200)),
                        'price' => rand(20000, 90000),
                        'created_at' => $dateTime,
                        'data_result' => $dateTime,
                        'user_id'=>  rand(1, 1),
                        'status' =>  rand(0, 4),
                    ]
                );

            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
