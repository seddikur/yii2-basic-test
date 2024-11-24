<?php

use yii\db\Migration;

/**
 * Данные для таблицы Organizations
 */
class m241124_142842_create_seed_organizations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $faker = \Faker\Factory::create('ru_RU');
        $dateTime = (new DateTime())->getTimestamp();
        for ($i = 0; $i < 10; $i++) {
            $this->insert(
                'organizations',
                [
                    'title' => $faker->company,
                    'description' => $faker->text(rand(100, 200)),
                    'created_at' => $dateTime,
                ]
            );

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }


}
